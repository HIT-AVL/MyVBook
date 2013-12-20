<!DOCTYPE html>
<html lang="ch">
<head>
<title>编辑微博书</title>
<meta charset="utf-8">
<link href="<?php echo MY_DIR;?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MY_DIR;?>css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MY_DIR;?>css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#page3 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-left nav {
	font-family: 微软雅黑;
}
#page3 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper {
	font-family: 微软雅黑;
}
</style>
<script type="text/javascript" src="<?php echo MY_DIR;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo MY_DIR;?>js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo MY_DIR;?>js/FuturisExtra_400.font.js"></script>
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
<body id="page3">
<form id="form1" name="form1" method="post" action="http://myvbook.sinaapp.com/mytest/index.php/weibo/convertopdf" >
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
                      <li><a href="http://myvbook.sinaapp.com/mytest/index.php/weibo/callback">提取范围</a></li>
                      <li><a href="http://myvbook.sinaapp.com/mytest/index.php/weibo/weibolist">选择微博</a></li>
                        <li class="act"><a href="http://myvbook.sinaapp.com/mytest/index.php/weibo/showpages/10000">编辑微博书</a></li>
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
                            <div class="wrapper">
                              <h2>编辑微博书</h2>
                              <p><span class="title">点击单选框选择模版和背景,并输入标题<span>选择完成后单击预览可以看到你的微博书</span>或者点击下载直接将微博书下载到本地</span></p>
                              <h2 class="extra">模版选择</h2>
                              <div class="wrapper">
                                <p>
                                <article class="col-1">
                                  <div align="center"><img src="<?php echo MY_DIR;?>images/model/jingdian.jpg" width="150" height="220"  alt=""/><br>
                                    <input type="radio" name="model" id="radio" value="0">
                                    <strong>经典样式</strong><br>
                                  </div>
                                </article>
                                <article class="col-2">
                                  <div align="center"><img src="<?php echo MY_DIR;?>images/model/pinglun.jpg" width="150" height="220"  alt=""/><br>
                                    <input type="radio" name="model" id="radio2" value="3">
                                   <strong> 经典样式(带评论) </strong><br>
                                  </div>
                                </article>
                                <article class="col-3">
                                  <div align="center"><img src="<?php echo MY_DIR;?>images/model/jiugong.jpg" width="150" height="220"  alt=""/><br>
                                    <input type="radio" name="model" id="radio3" value="1">
                                    <strong>九宫格 </strong><br>
                                  </div>
                                </article>
                                <article class="col-4">
                                  <div align="center"><img src="<?php echo MY_DIR;?>images/model/zuoyou.jpg" width="150" height="220"  alt=""/><br>
                                    <input type="radio" name="model" id="radio4" value="2">
                                    <strong>左右逢源 </strong><br>
                                  </div>
                                </article>
                                </p>
                              </div>
                              <h2 class="extra">背景选择</h2>
                              <div class="wrapper">
                              <p align="center">
                                <article class="col-5"><img src="<?php echo MY_DIR;?>images/newback/yangpi.jpg" width="200" height="270"  alt=""/><br><input type="radio" name="back" id="radio5" value="4"><strong>羊皮经典</strong><br></article>
                                <article class="col-6"><img src="<?php echo MY_DIR;?>images/newback/qianse.jpg" width="200" height="270"  alt=""/><br><input type="radio" name="back" id="radio6" value="5"><strong> 泛黄信纸 </strong><br></article>
                                <article class="col-7"><img src="<?php echo MY_DIR;?>images/newback/shuidi.jpg" width="200" height="270"  alt=""/><br><input type="radio" name="back" id="radio7" value="6"><strong> 记忆水滴</strong><br></article>
                                <article class="col-8"><img src="<?php echo MY_DIR;?>images/newback/lvse.jpg" width="200" height="270"  alt=""/><br><input type="radio" name="back" id="radio8" value="7"><strong> 绿色清新 </strong><br></article>
                                <article class="col-9"><img src="<?php echo MY_DIR;?>images/newback/lanse.jpg" width="200" height="270"  alt=""/><br><input type="radio" name="back" id="radio9" value="8"><strong>蓝色梦幻 </strong><br></article>
                                <article class="col-10"><img src="<?php echo MY_DIR;?>images/newback/dongri.jpg" width="200" height="270"  alt=""/><br><input type="radio" name="back" id="radio10" value="9"><strong> 冬日飘雪 </strong><br></article>                  
                              </p>
                              </div>
                              <h2 class="extra">输入标题</h2>
                               <div class="wrapper">
                                 <p>
                                   <input type="text" name="tittle" style="width:300px">
                                 </p>
                                 <p>
                                   <input type="checkbox" name="catalog" id="checkbox" value=1>
                                   启用目录
                                   <label for="checkbox"></label>
                                 </p>
                                 <p>
                                   <input type="submit" name="submit" id="submit" value="下载">
                                   <input type="submit" name="next" value="预览" onclick="javascript:this.form.action='http://myvbook.sinaapp.com/mytest/index.php/weibo/preshow';this.form.submit()" /> 
                                 </p>
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
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
