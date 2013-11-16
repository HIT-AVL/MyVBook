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
		//$data['pn']=$i;
		//$data['screen_name']=$this->user->screenname;
		//$data['message']=$this->user->ms;
		//$data['len']=count($data['message']);
		//$this->load->view('show');
		$this->showpages(0);

	}
	function showpages($i)
	{
	
		$this->user=unserialize($_SESSION["User"]);
		$data['pn']=$i;
		$data['screen_name']=$this->user->screenname;
		$data['message']=$this->user->ms;
		$data['len']=count($data['message']);
		$data['show']=$this->user->imgmask;
		//echo $data['len'];
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
			$this->load->view('choose');
		else
			$this->load->view('weibo_list',$data);
	}
	function show()
	{
		$this->user=unserialize($_SESSION["User"]);
		$ms=$this->user->ms;
		for($i=0;$i<count($ms);$i++) 
		{ 
			if($ms[$i]->used) 
			{
				echo $ms[$i]->text."\n" ; 
			}
		} 
	}
	function getfriends()
	{
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$uid_get = $c->get_uid();
		$uid = $uid_get['uid'];
		$data['friends']=$c->friends_by_id($uid);
		$this->load->view('friends',$data);
		
	}
	function downloads($name){
	
		
		if (!file_exists($name)){
			header("Content-type: text/html; charset=utf-8");
			echo "File not found!";
			exit; 
		} else {
			$file = fopen($file_dir.$name,"r"); 
			Header("Content-type: application/octet-stream");
			Header("Accept-Ranges: bytes");
			Header("Accept-Length: ".filesize($file_dir . $name));
			Header("Content-Disposition: attachment; filename=".$name);
			echo fread($file, filesize($file_dir.$name));
			fclose($file);
		}
	}
	function convertopdf()
	{
		if(isset($_POST['checkbox']))
			$checkbox = $_POST['checkbox']; 
		else
			$checkbos = array();
			//$chechvalue="";
		$mod = 2;
		$pic = 8;
		for($i=0;$i<count($checkbox);$i++) 
		{ 
			if(!is_null($checkbox[$i])) 
			{
				if($checkbox[$i]<3&&$checkbox[$i]<$mod)
					$mod = $checkbox[$i];
				if($checkbox[$i]>2&&$checkbox[$i]<$pic)
					$pic = $checkbox[$i];
			}
		} 
		$pic = $pic -3;
		unset($_POST['checkbox']);
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$this->load->model('vmodel');
		$this->user=unserialize($_SESSION["User"]);
		$ms=$this->user->ms;
		$this->vmodel->con($mod,$pic,$ms,$this->user->uid);
		$data['name']=$this->user->uid.'_'.$mod.'.pdf';
		$data['c']=$c;
		$this->load->view('download',$data);
		
	}
	
	
}
?>