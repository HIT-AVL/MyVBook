﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>浏览微博</title>
</head>
<style type="text/css">
body {
	background-image: url(http://myvbook.sinaapp.com/mytest/back3.png);
}
</style>
<body>
<?=$screen_name?>,您好！ 
<script type="text/javascript"> 
function check_all(obj,cName) 
{ 
    var checkboxs = document.getElementsByName(cName); 
    for(var i=0;i<checkboxs.length;i++){checkboxs[i].checked = obj.checked;} 
} 

</script> 
<form id="form1" name="form1" method="post" action="http://lmyvbook.sinaapp.com/mytest/index.php/weibo/showpages/<?php echo ($pn+1)?>" >
<p><input type="checkbox" name="all" onclick="check_all(this,'checkbox[]')" />全选/全不选</p> 
<table border="0" cellpadding="30" cellspacing="0" align="left">
<?php if( is_array( $message ) ): ?>
<?php for($i=$pn*10;$i<$pn*10+10&&$i<$len;$i++): ?>
<?php $item = $message[$i];?>
<?php if($item->img!=""&&$show==1 ):?>
<tr><th colspan="3"><?= $item->time;?></th></tr>
<tr>
<th><img src="<?=$item->img;?>" width="197" height="179" /></th>
<td><?=$item->text;?></td>
<td><input type="checkbox" id = "<?=$i;?>" name="checkbox[]" value ="<?=$i;?>" ></td>
</tr>
<?php else:?>
<tr><th colspan="3"><?= $item->time;?></th></tr>
<tr>
<th colspan="2" align="left" valign="center"><blink><?=$item->text;?></blink></th>
<td><input type="checkbox" id = "<?=$i;?>" name="checkbox[]" value ="<?=$i;?>" ></td>
</tr>
<?php endif; ?>
<?php endfor; ?>
<?php endif; ?>
<tr><th colspan="3" align="right">
<?php if($pn>0):?>
<input type="submit" name="next" value="上一页" onclick="javascript:this.form.action='http://myvbook.sinaapp.com/mytest/index.php/weibo/showpages/<?php echo ($pn-1)?>';this.form.submit()" />
<?php endif;?>
<?php if($len==0):?>
这段时间内您是不是没有发布任何微博？或者网速不太给力没有找到您发的微博，请返回重选。<br>
<input type="submit" name="next" value="返回重选" onclick="javascript:this.form.action='http://myvbook.sinaapp.com/mytest/index.php/weibo/callback';this.form.submit()" />
<?php endif;?>
<input type="submit" name="next" value="下一页" onclick="javascript:this.form.action='http://myvbook.sinaapp.com/mytest/index.php/weibo/showpages/<?php echo ($pn+1)?>';this.form.submit()" /> 
<input type="submit" name="submit" value="提交" onclick="javascript:this.form.action='http://myvbook.sinaapp.com/mytest/index.php/weibo/showpages/10000';this.form.submit()"/> </th></tr>
</table>
</form>
</body>
</html>