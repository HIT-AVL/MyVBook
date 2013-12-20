<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb">
<head>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
<title>下载与分享</title>
<meta charset="utf-8">
<link href="<?php echo MY_DIR;?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MY_DIR;?>css/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo MY_DIR;?>css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#page4 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-left nav {
	font-family: 微软雅黑;
}
#page4 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper-1 h2 {
	font-family: 微软雅黑;
}
#page4 #main-tail-ver #main-tail-top #main-bg-top #main #content-bg #content #indent .wrapper #column-right .content-box .tail .top .bot .inner .wrapper-1 {
	font-family: 微软雅黑;
}
</style>
<script type="text/javascript" src="<?php echo MY_DIR;?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo MY_DIR;?>js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo MY_DIR;?>js/FuturisExtra_400.font.js"></script>
<!--script type="text/javascript" src="js/cufon-replace.js"></script-->
<script type="text/javascript" src="<?php echo MY_DIR;?>js/jquery.galleriffic.js"></script>
<script type="text/javascript">
      jQuery(document).ready(function($) {
         // We only want these styles applied when javascript is enabled
         $('div.navigation').css({'width' : '701px', 'float' : 'left'});
         $('div.content-gallery').css('display', 'block');
   
         // Initially set opacity on thumbs and add
         // additional styling for hover effect on thumbs
         var onMouseOutOpacity = 0.67;
         $('#thumbs ul.thumbs li').opacityrollover({
            mouseOutOpacity:   onMouseOutOpacity,
            mouseOverOpacity:  1.0,
            fadeSpeed:         'fast',
            exemptionSelector: '.selected'
         });
         
         // Initialize Advanced Galleriffic Gallery
         var gallery = $('#thumbs').galleriffic({
            delay:                     2500,
            numThumbs:                 3,
            preloadAhead:              3,
            enableTopPager:            true,
            enableBottomPager:         true,
            maxPagesToShow:            7,
            imageContainerSel:         '#slideshow',
            controlsContainerSel:      '#controls',
            captionContainerSel:       '#caption',
            loadingContainerSel:       '#loading',
            renderSSControls:          true,
            renderNavControls:         true,
            playLinkText:              'Play Slideshow',
            pauseLinkText:             'Pause Slideshow',
            prevLinkText:              'previous',
            nextLinkText:              'next',
            nextPageLinkText:          'Next &rsaquo;',
            prevPageLinkText:          '&lsaquo; Prev',
            enableHistory:             false,
            autoStart:                 false,
            syncTransitions:           true,
            defaultTransitionDuration: 900,
            onSlideChange:             function(prevIndex, nextIndex) {
               // 'this' refers to the gallery, which is an extension of $('#thumbs')
               this.find('ul.thumbs').children()
                  .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                  .eq(nextIndex).fadeTo('fast', 1.0);
            },
            onPageTransitionOut:       function(callback) {
               this.fadeTo('fast', 0.0, callback);
            },
            onPageTransitionIn:        function() {
               this.fadeTo('fast', 1.0);
            }
         });
      });
   </script>
<script type="text/javascript" src="<?php echo MY_DIR;?>js/jquery.opacityrollover.js"></script>
<!--[if lt IE 7]>
     <script type="text/javascript" src="js/ie_png.js"></script>
     <script type="text/javascript">
     ie_png.fix('.png, #twitter, .carousel-box button.prev, .carousel-box button.next, div.nav-controls a.prev, div.nav-controls a.next');
     </script>
     <link href="css/ie/ie6.css" rel="stylesheet" type="text/css" />
   <![endif]-->
<!--[if IE]>
      <script type="text/javascript" src="js/html5.js"></script>
   <![endif]-->
</head>
<body id="page4">
<div id="tail-top-right"></div>
<div id="main-tail-ver">
  <div id="main-tail-top">
    <div id="main-bg-top">
      <div id="main">
        <!-- header -->
        <div id="header-bg">
          <header>
              <h1><a href="http://myvbook.sinaapp.com"><span>webstudio</span></a></h1>
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
                      <li>选择微博</li>
                        <li><a href="http://myvbook.sinaapp.com/mytest/index.php/weibo/showpages/10000">编辑微博书</a></li>
                      <li class="act"><a href="http://myvbook.sinaapp.com/mytest/index.php/weibo/convertopdf">下载与分享</a></li>
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
                              <h2>下载与分享</h2>
                              <p><span class="title">点击下载可以将生成的微博书下载到本地<span>点击分享到新浪微博可以把微博书分享给好友们</span></span></p>
                              <!-- Start Advanced Gallery Html Containers -->
                              <div class="wrapper">
                                  <div align="center"><a href="http://myvbook.sinaapp.com/mytest/index.php/download/downloads/<?php echo $name;?>"><img src="<?php echo MY_DIR;?>images/01300000439274124730761176123_s.png" width="300" height="243"  alt=""/></a></div>
                              </div>
                               <wb:publish action="pubilish" type="web" language="zh_cn" button_type="red" button_size="middle" button_text="分享到新浪微博" default_text="我生成了一本微博书快来看看吧。http://myvbook.sinaapp.com" refer="y" appkey="5teVQX" ></wb:publish>
                              <!-- END Advanced Gallery Html Containers -->
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
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>