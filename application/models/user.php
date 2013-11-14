<?php
class message{
	$text;
	$img;
	$time;
function __construct($te,$im,$ti)
{
	$this->text=$te;
	$this->img = $im;
	$this->time = $ti;
}
}
class User_model extends CI_Model{
var $uid = 0;
var $screenname = "";
var $ms = array{};
var $usedmodel=array{};
var $vbooklist=array{};
function __construct()
{
	parent::__construct();
}
function get_ms($message)
{

	$i=0;
	if( is_array( $message['statuses'] ) )
	{
		foreach( $message['statuses'] as $item )
			$ms[$i]=new message($item['text'],$item['thumbnail_pic'],$item['created_at']);
	}

}
}