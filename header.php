<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
<?php wp_title( '|', true, 'right' );?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo('template_url')?>/jquery.mobile-1.3.1.css">
<script src="<?php bloginfo('template_url')?>/jquery-1.8.3.min.js"></script>
<script src="<?php bloginfo('template_url')?>/js/iscroll-lite.js"></script>
<script type="text/javascript">
var myScroll;
function loaded() {
	setTimeout(function () {
		myScroll = new iScroll('nav-wrapper');
	}, 100);
}
window.addEventListener('load', loaded, false);
</script>
<script type='text/javascript'>

	$(document).on('pageshow',function(){
	
	
	/*
 * Swipe 2.0
 *
 * 参考地址：https://github.com/bradbirdsall/Swipe
   使用方法：
   html部分：
	<div id='slider' class='swipe'>
		<div class='swipe-wrap'>
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
	
	css部分：
	.swipe {
	  overflow: hidden;
	  visibility: hidden;
	  position: relative;
	}
	.swipe-wrap {
	  overflow: hidden;
	  position: relative;
	}
	.swipe-wrap > div {
	  float:left;
	  width:100%;
	  position: relative;
	}
	函数API:
	startSlide Integer (default:0) - index position Swipe should start at　　（滑动开始的索引值，默认值为0）
	
	speed Integer (default:300) - speed of prev and next transitions in milliseconds.（滑动的速度，默认值300毫秒）
	
	auto Integer - begin with auto slideshow (time in milliseconds between slides)（自动开始滑动，间隔时间为speed的值）
	
	continuous Boolean (default:true) - create an infinite feel with no endpoints（是否循环播放，无终点，默认值为true）
	
	disableScroll Boolean (default:false) - stop any touches on this container from scrolling the page（当滚动滚动条的时候停止容器的滑动事件，默认值flase）
	
	stopPropagation Boolean (default:false) - stop event propagation（停止事件的累积）
	
	callback Function - runs at slide change.（回调函数）
	
	transitionEnd Function - runs at the end slide transition.（滑动过渡时调用的函数）

*/
// pure JS
	var bullets = document.getElementById('position').getElementsByTagName('li');
	var slider = 
	  Swipe(document.getElementById('slider'), {
		auto: 3000,
		continuous: true,
		/*1.此处注意：此处官方文档没有，为位置显示部分函数，通过回调函数实现，如有问题及时反馈。
		  2.实现思路：callback在slide change的时候触发，此时通过传参pos，注意此处的pos的值为0，1 2，3……即li数组的下标，有兴趣研究的请自己参看Swipe源代码
		  3.使用时注意：要li的个数与要切换的图片个数一致，同时第一个li的要加上class="on"
		  4.在手机端当用户实施滑动行为时，说明用户已经操作这时候自动滚动会被终止，为swipe设计，非bug.
		  
		*/
		
		callback: function(pos) {
			
		  var i = bullets.length;
		 
		  while (i--) {
			bullets[i].className = '';
		  }
		  bullets[pos].className = 'on';
	
		}
	  });
	    
	  
	$(".headerTitle").on("swiperight",function(){
		$("#leftpanel").panel( "open");
	});
	$(".headerTitle").on("swipeleft",function(){
		$("#rightpanel").panel( "open");
	});
	$( "#newsToggle" ).on( 'tap', newsToggle );
 
	function newsToggle( event ) {
		$( "#leftpanel" ).panel( "toggle" );
	}
	
	$( "#account" ).on( 'tap', accountToggle );
 
	function accountToggle( event ) {
		$( "#rightpanel" ).panel( "toggle" );
	}
});
</script>
<link rel="stylesheet" href="<?php bloginfo('template_url')?>/css/global.css" />
<link href="<?php bloginfo('template_url')?>/css/swipeCss.css" rel="stylesheet" type="text/css">
<script src="<?php bloginfo('template_url')?>/js/swipe.js"></script>
<script>
 $(document).delegate("#index","pageinit", function() {
	$.mobile.ajaxEnabled=false;
	$(".headerTitle").on("swiperight",function(){
		$("#leftpanel").panel( "open");
	});
	$(".headerTitle").on("swipeleft",function(){
		$("#rightpanel").panel( "open");
	});
	$( ".leftPanelImg" ).on( 'tap', newsToggle );
 
	function newsToggle( event ) {
		$( "#leftpanel" ).panel( "toggle" );
	}
	
	$( ".leftPanelImg3" ).on( 'tap', accountToggle );
 
	function accountToggle( event ) {
		$( "#rightpanel" ).panel( "toggle" );
	}

 });

</script>
<script>
 $(document).delegate("#index","pageinit", function() {
	$.mobile.ajaxEnabled=false;
 });
</script>
<script src="<?php bloginfo('template_url')?>/jquery.mobile-1.3.1.js"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url')?>/css/global.css" />
<link href="<?php bloginfo('template_url')?>/css/swipeCss.css" rel="stylesheet" type="text/css">
<?php
 if ( is_singular() && get_option( 'thread_comments' ) )
 wp_enqueue_script( 'comment-reply' );
 wp_head();
 ?>
 <!-- start infinite scroll function  -->

<?php if (!is_single() || !is_page()): ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        var count = 2;
        var total = <?php echo $wp_query->max_num_pages; ?>;
        $(window).scroll(function(){
		
                if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                   if (count > total){
                   	  	return false;
                   }else{
                   		loadArticle(count);
                   }
                   count++;
                }
        }); 

        function loadArticle(pageNumber){   
                $('a#inifiniteLoader').show('fast');
                $.ajax({
                    url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
                    type:'POST',
                    data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop', 
                    success: function(html){
                        $('a#inifiniteLoader').hide('1000');
                        $("#thelist li:last").append(html);    // This will be the div where our content will be loaded
						$("#thelist").listview('refresh');
                    }
                });
            return false;
        }

    });

</script>

<!-- end infinite scroll pagination -->
<?php endif; ?>	

</head>
<body <?php body_class(); ?>>
<div data-role="page" id="index">
<div data-role="header" data-position="inline">
  <h1 class="headerTitle"><span class="leftPanelImg"></span><span class="leftPanelImg2">
    <?php bloginfo('name'); ?><?php wp_title( '|', true, 'left' );?>
    </span><span class="leftPanelImg3"></span></h1>
  <div class="clearfix"></div>
  <!-- 顶部条 Start -->
 
  <div id="nav-holder">
    <div id="nav-wrapper" class="topbar channel-topbar mlego-toolbar">
      <ul id="nav-scroller">
        <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
      </ul>
    </div>
  </div>
  
  <!-- 顶部条 End --> 
  
</div>
<!-- /header --> 
<!-- /panel -->
<div data-role="panel" id="leftpanel" data-display="reveal" data-position="left">
  <ul data-role='listview' id="newsList">
    <li data-theme='a'><a href="<?php bloginfo("url");?>">首页</a></li>
    <li><a href="<?php bloginfo("url");?>/category/news">新闻</a></li>
    <li><a href="<?php bloginfo("url");?>/category/video">视频</a></li>
    <li><a href="<?php bloginfo("url");?>/category/amuse">趣吧</a></li>
    <li><a href="<?php bloginfo("url");?>/category/app">应用</a></li>
  </ul>
</div>
<!-- /panel -->
<div data-role="panel" id="rightpanel" data-display="push" data-position="right" data-theme="e">
  <ul data-role='listview'>
    <li data-theme='a'>我的帐号</li>
  </ul>
</div>
<!-- /panel -->
<div data-role="content">
