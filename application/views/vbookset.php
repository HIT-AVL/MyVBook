﻿<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>选择提取微博条件</title></head>
<body>
<form	action="http://myvbook.sinaapp.com/mytest/index.php/weibo/weibolist" method="post">
<style type="text/css">
body {
	background-image: url(http://myvbook.sinaapp.com/mytest/back3.png);
	margin-top: 5%;
}
</style>
<link href="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-ui-effects.custom.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.datepicker-zh-CN.js" type="text/javascript"></script>
<table width="800" height="600" border="1" align="center">
  <tr>
    <th height="80" colspan="2" scope="col"><table width="800" height="600" border="1" align="center">
      <tr>
        <th height="80" colspan="2" scope="col"><img src="<?php echo MY_DIR?>pic/getout.png" width="171" height="75"  alt=""/></th>
      </tr>
      <tr>
        <td width="50%" height="158"><div align="center" margin-top: 5% >
          <p>起始时间 (如:12/04/2012)</p>
          <p>
            <input type="text" name="begt" id="Datepicker1">
          </p>
        </div></td>
        <td width="50%"><div align="center" >
          <p>结束时间(如:12/04/2013)</p>
          <p>
            <input type="text" name="endt" id="Datepicker2">
          </p>
        </div></td>
      </tr>
      <tr>
        <td height="10"><label for="checkbox"> </label>
          <div align="center">
            <input type="checkbox" name="picture" id="checkbox">
            显示图片</div></td>
        <td ><label for="checkbox2"> </label>
          <div align="center">
            <input type="checkbox" name="com" id="checkbox2">
            提取评论</div></td>
      </tr>
      <tr>
        <td height="10" colspan="2"><div align="center">
          <input type="submit" name="submit" id="submit" value="提交">
        </div></td>
      </tr>
    </table></th>
  </tr>
</table>
<script type="text/javascript">
$(function() {
	$( "#Datepicker1" ).datepicker(
	{
		changeMonth:true,
		changeYear:true
	}
	); 
	
});
$(function() {
	$( "#Datepicker2" ).datepicker(
	{
		changeMonth:true,
		changeYear:true
	}
	); 
});
</script>
</form>
</body>
</html>