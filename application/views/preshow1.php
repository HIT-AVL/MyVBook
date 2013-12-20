<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>微博书预览</title></head>
<style type="text/css">
body {
    background-size:cover; 
	background-image: url(<?=$pic?>);
}
</style>
<body>
<table border="0" cellpadding="20" cellspacing="0" align="center">
    <?php for($ll=0,$i=$len-2;$ll <9;$i-- ):?>
    <?php if($i>=0):?>
					<?php $item=$ms[$i];?>
    <?php else:?>
					<?php $item=$ms[$len-1];$item->used=true;?>
    <?php endif;?>  
    <?php if($item->used):?>
		  <?php $time=$item->time;?>
         
    <?php if($ll%3==0):?>
			<tr>
    <?php endif;?>
	<td width="360" align="center" valign="top" font style="font-size:25px;font-weight:bold;color:#003366;}">
			<?=$time?><br /><br /><br />
    <?php	if($item->img!=""):?>
					<img src="<?=$item->img?>"  height="125" /><br />
						<?=$item->text?><br /></td>
    <?php else:?>

						<?=$item->text?><br /></td>
	<?php endif;?>		
    <?php	if($ll%3==2):?>
			</tr>
    <?php endif;?>
			<?php		$ll++;?>
    <?php endif;?>
	<?php endfor;?>
    <tr><td>
    <form id="form1" name="form1" method="post" action="">
    <input type="submit" name="next" value="返回重新编辑微博书" onclick="javascript:this.form.action='http://myvbook.sinaapp.com/mytest/index.php/weibo/showpages/10000';this.form.submit()" />
    <input type="submit" name="nxt" value="生成微博书" onclick="javascript:this.form.action='http://myvbook.sinaapp.com/mytest/index.php/weibo/makebook';this.form.submit()" />
    </form>
    </td></tr>
    </table>
</body>
</html>