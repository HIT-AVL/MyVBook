<?php
class comment{
var $cid;
var $text;
var $time;
var $cname;
function __construct($id,$txt,$tt,$uname)
{
	$this->cid=$id;
	$this->text=$txt;
	$this->time=$tt;
	$this->cname=$uname;
}
};
class message{
var	$text;
var	$img;
var	$time;
var $ttime;
var $id;
var $ci=0;
var $comments=array();
function __construct($te,$im,$ti,$tti,$mid)
{
	$this->text=$te;
	$this->img = $im;
	$this->time = $ti;
	$this->ttime=$tti;
	$this->id=$mid;
	$this->used=false;
}
function get_comments($cm)
{
	foreach($cm['comments'] as $tmp)
	{
		//print_r($tmp);
		$this->comments[$this->ci]=new comment($tmp['id'],$tmp['text'],entocht($tmp['created_at']),$tmp['user']['screen_name']);
		$this->ci++;
	}
}
}

class user extends CI_Model{
var $uid;
var $screenname;
var $ms=array();
var $usedmodel=array();
var $vbooklist=array();
var $begt=0;
var $endt=0;
var $imgmask=0;
var $idx=0;
var $endf=false;
var $com=false;
var $c;
	
function __construct()
{
	parent::__construct();
}
function get_ms($message)
{

	$i=$this->idx;
	if( is_array( $message['statuses'] ) )
	{
		foreach( $message['statuses'] as $item )
		{
			if(strtotime($item['created_at'])>$this->endt)
				continue;
			if(strtotime($item['created_at'])<$this->begt)
			{
				$this->endf=true;
				break;
			}
			$pic="";
			$text="";
			$tm=explode("//@",$item['text']);
			$text.=$tm[0];
			if(count($tm)>1)
			{
				$text=$text."<br> 转自：";
				$text.=$tm[1];
			}
			if(isset($item['thumbnail_pic'])>0)
			{
				$pic=$item['thumbnail_pic'];
			}
			else if(isset($item['retweeted_status']))
			{
				if(isset($item['retweeted_status']['thumbnail_pic']))
				$pic=$item['retweeted_status']['thumbnail_pic'];
				$text.=$item['retweeted_status']['text'];
			}
			
			$this->ms[$i]=new message($text,$pic,entocht($item['created_at']),entomyt($item['created_at']),$item['idstr']);
			$i++;
		}
	}
    $this->ms[$i]=new message("","","","","");
	$this->idx = $i;

}
}