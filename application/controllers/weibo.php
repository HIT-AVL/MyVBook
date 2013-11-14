<?php

session_start();
include_once( APPPATH.'/libraries/saetv2.ex.class.php' );

class Weibo extends CI_Controller {

	
	
	function index()
	{
		$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );
		$data['code_url'] = $o->getAuthorizeURL( WB_CALLBACK_URL );
	    $this->load->view('author_view',$data);
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
		
		$this->load->view('callback',$data);

	
		
	}
	function weibolist()
	{
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$uid_get = $c->get_uid();
		$uid = $uid_get['uid'];
		$data['ms']  = $c->user_timeline_by_id($uid); // don
		$data['user_message'] = $c->show_user_by_id( $uid);
		$data['c']=$c;
		$this->load->view('weibo_list',$data);
		

	}
	function getfriends()
	{
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$uid_get = $c->get_uid();
		$uid = $uid_get['uid'];
		$data['friends']=$c->friends_by_id($uid);
		$this->load->view('friends',$data);
		
	}
	function convertopdf()
	{
		require_once( APPPATH.'/libraries/tcpdf/config/lang/chi.php');
		require_once( APPPATH.'/libraries/tcpdf/tcpdf.php');
		$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
		$uid_get = $c->get_uid();
		$uid = $uid_get['uid'];
		$ms  = $c->user_timeline_by_id($uid); // don
		$user_message = $c->show_user_by_id( $uid);
		$html= <<<EOF
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charxset=utf-8" />
		<title>好友列表显示</title>
		</head>
		<body>
EOF;
		$html.='<img src="http://www.ninedns.com/images/tech/images/A5385_IMG200748_1.gif" width="440" height="330"/>';
		foreach( $ms['statuses'] as $item)
		{
			$html.='<div style="padding:10px;margin:5px;border:1px solid #ccc">';
			$html.=$item['text'];
			$html.='</div>';
		}
		$html.='</body>';
		$html.='</html>';
		$fout=fopen('limu.htm',"w");
		fwrite($fout,$html);
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('中文');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray($l);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('droidsansfallback', '', 12);
		$pdf->AddPage();
		$pdf->SetTextColor(0, 63, 127);
		$pdf->Image("beijing.jpg",0,0);
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->lastPage();
		$pdf->Output($user_message['screen_name'].'.pdf', 'FI');

		
		
	}
	
	
}
?>