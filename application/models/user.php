<?php
class message{
var	$text;
var	$img;
var	$time;
var $id;
function __construct($te,$im,$ti,$mid)
{
	$this->text=$te;
	$this->img = $im;
	$this->time = $ti;
	$this->id=$mid;
	$this->used=false;
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
			$text.=$item['text'];
			$this->ms[$i]=new message($text,$pic,$item['created_at'],$item['id']);
			$i++;
		}
	}
	$this->idx = $i;

}
}