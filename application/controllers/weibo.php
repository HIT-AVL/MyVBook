<?php
session_start();
include_once( APPPATH.'/libraries/saetv2.ex.class.php' );

class Weibo extends CI_Controller {
	function __construct()
	{
		
		parent::__construct();
		$this->load->model('user');
		error_reporting(E_ALL^E_WARNING^E_NOTICE);
		//$this->load->library('session');
	}	
	
	function index()
	{
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$data['code_url'] = $o->getAuthorizeURL( WB_CALLBACK_URL );
	    $this->load->view('authorize',$data);
	}
	
	function callback()
	{
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$data['flag']=FALSE;
		if (isset($_REQUEST['code'])) {
		$keys = array();
		$keys['code'] = $_REQUEST['code'];
		$keys['redirect_uri'] = WB_CALLBACK_URL;
		try {
			$token = $o->getAccessToken( 'code', $keys ) ;
		} catch (OAuthException $e) {
		}
		if ($token) {
		$_SESSION['token'] = $token;
		setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );}
		$data['flag']=TRUE;
		}
		$this->load->view('vbookset',$data);
		
	}


	function setdata()
	{
		$this->load->view('vbookset');
	}
	function weibolist()
	{
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$uid_get = $c->get_uid();
		$uid = $uid_get['uid'];
		$this->user->uid=$uid;
		$this->user->begt= strtotime($_POST['begt']);
		$this->user->endt= strtotime($_POST['endt']);
		if(isset($_POST['com']))
			$this->user->com = true;
		if(isset($_POST['picture']))
			$this->user->imgmask=1;
		//user_timeline_by_id( $uid = NULL , $page = 1 , $count = 50 , $since_id = 0, $max_id = 0, $feature = 0, $trim_user = 0, $base_app = 0)
		for($i=1;$i<20;$i++)
		{
			if($this->user->endf)
				break;
			$ms= $c->user_timeline_by_id($uid,$i,100,0,0,0,1,0); // don
			if(count($ms["statuses"])==0)
			$this->user->endf=true;
			$this->user->get_ms($ms);
		}
		$screen=$c->show_user_by_id($uid);
		$this->user->screenname=$screen['screen_name'];

		$storeuser=serialize($this->user);
		$_SESSION["User"]=$storeuser;
		$this->showpages(0);

	}
	function get_comments()
	{
		$this->user=unserialize($_SESSION["User"]);
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$len = count($this->user->ms);
		for($i=0;$i<$len;$i++)
		{
			$tmp = $this->user->ms[$i];
			if($tmp->used)
			{
				$this->user->ms[$i]->ci=0;
				$cm=$c->get_comments_by_sid($tmp->id);		
				$this->user->ms[$i]->get_comments($cm);
			}
		}
		
	}
	function showpages($i)
	{
		
		$this->user=unserialize($_SESSION["User"]);
		$data['pn']=$i;
		$data['screen_name']=$this->user->screenname;
		$data['message']=$this->user->ms;
		$data['len']=count($data['message'])-1;
		$data['show']=$this->user->imgmask;
		$f= false;
		if($i>0)
		{
			if($i*10>$data['len'])
				$f = true;
			if(isset($_POST['checkbox']))
				$checkbox = $_POST['checkbox']; 
			else
				$checkbos = array();
			//$chechvalue="";
			$ll=$i*10;
			if($ll>$data['len'])
				$ll=$data['len'];
			for($j=$i*10-10;$j<$ll;$j++)
				$this->user->ms[$j]->used=false;
			for($i=0;$i<count($checkbox);$i++) 
			{ 
				if(!is_null($checkbox[$i])) 
					$this->user->ms[$checkbox[$i]]->used=true;
					//$chechvalue.=$checkbox[$i]; 
			} 
			//echo $chechvalue;
		}
		$storeuser=serialize($this->user);
		$_SESSION["User"]=$storeuser;
		if($f)
		{
			
			if($this->user->com)
				$this->get_comments();
			$storeuser=serialize($this->user);
			$_SESSION["User"]=$storeuser;
			$this->load->view('choose');
		}
		else
			$this->load->view('weibo_list',$data);
	}

	function downloads($name){

        $s = new SaeStorage();
        $domain="stmyvbook";
        //  $url=$s->getUrl($domain,$name);
        //echo $url;
        //die();
       
		if (!$s->fileExists($domain,$name)){
			header("Content-type: text/html; charset=utf-8");
			echo "File not found!";
			exit; 
		} else {
            $attr = $s->getAttr($domain, $name);
            ob_clean();
            header("Content-Type: application/octet-stream");
           	header("Content-Disposition:  attachment; filename=\"".$name."\"");
	 		header("Content-Transfer-Encoding: binary");
	 		header("Content-Length:  ". $attr["Length"]);
            //ob_clean();
		    echo $s->read($domain, $name);
            // ob_end_flush();
            exit;
		}
		$data['name']=$name;
        $this->load->view('download',$data);
      
        //$stor->delete($domain, $name);
	}
    function settittle()
    {
		
		$mod = 3;
		$pic = 9;
		if(isset($_POST['model']))
			$mod=$_POST['model'];
		if(isset($_POST['back']))
			$pic=$_POST['back'];
		$pic = $pic -4;
		unset($_POST['checkbox']);
        $_SESSION["Mod"]=$mod;
        $_SESSION["Pic"]=$pic;
        $this->load->view('tbset');
        	
    }
    function preshow()
    {
        $cat=0;
        $tit="myvbook";
        $mod = 3;
		$pic = 9;
        $this->user=unserialize($_SESSION["User"]);
		if(isset($_POST['model']))
			$mod=$_POST['model'];
		if(isset($_POST['back']))
			$pic=$_POST['back'];
		$pic = $pic -4;
        if(isset($_POST['catalog']))
			$cat=$_POST['catalog'];
        if(isset($_POST['tittle']))
			$tit=$_POST['tittle'];
        $_SESSION["Mod"]=$mod;
        $_SESSION["Pic"]=$pic;
        $_SESSION["Cat"]=$cat;
        $_SESSION["Tit"]=$tit;
        $pics=array("tupian/yangpi.jpg","tupian/dongri.jpg","tupian/lanse.jpg","tupian/lvse.jpg","tupian/shuidi.jpg","tupian/qianse.jpg");
        $data['pic']="http://myvbook.sinaapp.com/mytest/".$pics[$pic];
        $data['ms']=$this->user->ms;
        $data['len']=count($this->user->ms);
        $name='preshow'.$mod;
        $this->load->view($name,$data);
    }
    function makebook()
    {
        $mod=$_SESSION["Mod"];
        $pic=$_SESSION["Pic"];
        $cat=$_SESSION["Cat"];
        $tit=$_SESSION["Tit"];
        $this->load->model('vmodel');
		$this->user=unserialize($_SESSION["User"]);
        if($tit=="")
            $tit="myvbook";
        //foreach($this->user->ms as $item)
            //	print_r($item->ttime);
        //		die();
        $this->vmodel->uname=$this->user->screenname;
        $this->vmodel->cct=$cat;
        $this->vmodel->tittle=$tit;
		$ms=$this->user->ms;
		$this->vmodel->con($mod,$pic,$ms,$this->user->uid);
		$data['name']=$this->user->uid.'_'.$mod.'.pdf';
		$this->load->view('download',$data);
    }
	function convertopdf()
	{
        $cat=0;
        $tit="myvbook";
        $mod = 3;
		$pic = 9;
		if(isset($_POST['model']))
			$mod=$_POST['model'];
		if(isset($_POST['back']))
			$pic=$_POST['back'];
		$pic = $pic -4;
        if(isset($_POST['catalog']))
			$cat=$_POST['catalog'];
        if(isset($_POST['tittle']))
			$tit=$_POST['tittle'];
		$this->load->model('vmodel');
		$this->user=unserialize($_SESSION["User"]);
        if($tit=="")
            $tit="myvbook";
        //foreach($this->user->ms as $item)
            //	print_r($item->ttime);
        //		die();
        $this->vmodel->uname=$this->user->screenname;
        $this->vmodel->cct=$cat;
        $this->vmodel->tittle=$tit;
		$ms=$this->user->ms;
		$this->vmodel->con($mod,$pic,$ms,$this->user->uid);
		$data['name']=$this->user->uid.'_'.$mod.'.pdf';
		$this->load->view('download',$data);
		
	}
	
	
}
?>