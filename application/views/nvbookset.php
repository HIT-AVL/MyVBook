<!DOCTYPE html>
<html lang="ch">
<head>
<title>提取范围</title>
<meta charset="utf-8">
<link href="<?php echo MY_DIR;?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MY_DIR;?>css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MY_DIR;?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
#page2 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-left nav {
	font-family: 微软雅黑;
}
#page2 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper .wrapper .col-1 .extra {
	font-family: 微软雅黑;
}
#page2 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper .wrapper .col-2 .extra {
	font-family: 微软雅黑;
}
#page2 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper-1 .wrapper .col-1 .extra {
	font-family: 微软雅黑;
}
#page2 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper-1 .wrapper .col-2 .extra {
	font-family: 微软雅黑;
}
#page2 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper-1 .title {
	font-family: 微软雅黑;
}
#page2 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper-1 .extra {
	font-family: 微软雅黑;
}
</style>

<script type="text/javascript" src="<?php echo MY_DIR;?>js/jquery-1.4.2.min.js"></script>
<!--script type="text/javascript" src="js/cufon-yui.js"></script-->
<script type="text/javascript" src="<?php echo MY_DIR;?>js/FuturisExtra_400.font.js"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-ui-effects.custom.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
<script src="<?php echo MY_DIR;?>jQueryAssets/jquery.ui.datepicker-zh-CN.js" type="text/javascript"></script>
<!--script type="text/javascript" src="js/cufon-replace.js"></script-->
<!--[if lt IE 7]>
     <script type="text/javascript" src="js/ie_png.js"></script>
     <script type="text/javascript">
     ie_png.fix('.png, #twitter, .carousel-box button.prev, .carousel-box button.next');
     </script>
     <link href="css/ie/ie6.css" rel="stylesheet" type="text/css" />
   <![endif]-->
<!--[if IE]>
      <script type="text/javascript" src="js/html5.js"></script>
   <![endif]-->
</head>
<body id="page2">
<form	action="http://myvbook.sinaapp.com/mytest/index.php/weibo/weibolist" method="post">
<div id="tail-top-right"></div>
<div id="main-tail-ver">
  <div id="main-tail-top">
    <div id="main-bg-top">
      <div id="main"> 
        <!-- header -->
        <div id="header-bg">
          <header>
            <h1><a href="http://myvbook.sinaapp.com/"><span>webstudio</span></a></h1>
            <strong>hit-avl</strong> </header>
        </div>
        <!-- content -->
        <div id="content-bg">
          <section id="content">
            <div id="indent">
              <div class="wrapper">
                <article id="column-left">
                  <nav>
                    <ul>
                      <li class="act"><a href="http://myvbook.sinaapp.com/mytest/index.php/weibo/callback">提取范围</a></li>
                      <li>选择微博</li>
                      <li>编辑微博书</li>
                      <li>下载和分享</li>
                    </ul>
                  </nav>
                </article>
                <article id="column-right">
                  <div class="content-box">
                    <div class="tail">
                      <div class="top">
                        <div class="bot">
                          <div class="inner">
                            <div class="wrapper-1">
                              <h2 align="left" class="extra">提取范围</h2>
                              <div class="title">单击输入框可选择时间,或者手动输入时间格式如下:<span>12/04/2012</span>输入完成后单击提交以继续</div>
                              <div class="wrapper">
                                <article class="col-1">
                                  <h2 class="extra">起始时间</h2>
                                  <p>
                                    <input type="text" name="begt" id="Datepicker1">
                                  </p>
                                  <div align="center">
                                    <input type="checkbox" name="picture" id="checkbox">
                                    <strong> 显示图片</strong></div>
                                  <div class="clear"></div>
                                </article>
                                <article class="col-2">
                                  <h2 class="extra">结束时间</h2>
                                  <p>
                                    <input type="text" name="endt" id="Datepicker2">
                                  </p>
                                  <div align="center">
                                    <input type="checkbox" name="com" id="checkbox2">
                                    <strong>提取评论</strong> </div>
                                </article>
                              </div>
                              <div align="center">
                                <input type="submit" value="下一步">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </div>
          </section>
        </div>
        <!-- footer -->
        <div id="footer-tail"></div>
      </div>
    </div>
  </div>
</div>
</form>
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
</body>
</html>