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
    <?php for($ll=0,$i=$len-2;$ll <78&&$i>=0;$i-- ):?>
	<?php	$item=$ms[$i];$time=$item->time;?>	
    <?php if($item->used):?>
	<tr>
        <td align="center" colspan="2" width ="1080" height ="30"  font style=" font-size:40px;font-weight:bold;color:#003366;}"><?=$time?></td ></tr>
  			  <?php if($item->img!=""):?>
						<tr>
						<td width ="360"  align="center"><img src="<?=$item->img?>" height="125"></td>
                            <td width ="720" font style=" font-size:30px;font-weight:bold;color:#666666;}"><?=$item->text?></td>
						</tr>
						<?php $ll+=20?>
			
 		     <?php else:?>
						<tr>
						
                            <td align="left" width ="1080" font style=" font-size:30px;font-weight:bold;color:#666666;}"><?=$item->text?></td>
						</tr>
						<?php $ll+=20?>
			<?php endif;?>
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