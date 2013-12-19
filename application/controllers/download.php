<?php
session_start();
class Download extends CI_Controller {
	function __construct()
	{
		
		parent::__construct();
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
            header("Content-Type: application/octet-stream");
           	header("Content-Disposition:  attachment; filename=\"".$name."\"");
	 		header("Content-Transfer-Encoding: binary");
	 		header("Content-Length:  ". $attr["Length"]);
		    echo $s->read($domain, $name);
            exit;
		}
	}
	
}
?>