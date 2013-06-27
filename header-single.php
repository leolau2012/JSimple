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
<script type="text/javascript">

var myScroll,
	pullDownEl, pullDownOffset,
	pullUpEl, pullUpOffset,
	generatedCount = 0;


function pullUpAction () {
	setTimeout(function () {	// <-- Simulate network congestion, remove setTimeout from production!
		var el, li, i;
		el = document.getElementById('thelist');

		for (i=0; i<3; i++) {
			li = document.createElement('li');
			li.innerHTML = "<img src=\"<?php bloginfo('template_url')?>/images/newsListImg.png\"  />";
			li.innerHTML+="<h2>微软发布下一代游戏机XBOX one</h2>";
			li.innerHTML+="<p>一张游戏盘只能安装一次,不兼容旧版本xbox360游戏</p>";
			el.appendChild(li, el.childNodes[0]);
			$("#thelist").listview('refresh');
		}
		
		myScroll.refresh();		// Remember to refresh when contents are loaded (ie: on ajax completion)
	}, 1000);	// <-- Simulate network congestion, remove setTimeout from production!
}

function loaded() {

	pullUpEl = document.getElementById('pullUp');	
	pullUpOffset = pullUpEl.offsetHeight;
	
	myScroll = new iScroll('wrapper', {
		useTransition: true,
		topOffset: pullDownOffset,
		onRefresh: function () {
			if (pullUpEl.className.match('loading')) {
				pullUpEl.className = '';
				pullUpEl.querySelector('.pullUpLabel').innerHTML = '向上拉显示更多';
			}
		},
		onScrollMove: function () {
			if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
				pullUpEl.className = 'flip';
				pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手刷新';
				this.maxScrollY = this.maxScrollY;
			} else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
				pullUpEl.className = '';
				pullUpEl.querySelector('.pullUpLabel').innerHTML = '向上拉显示更多';
				this.maxScrollY = pullUpOffset;
			}
		},
		onScrollEnd: function () {
			if (pullUpEl.className.match('flip')) {
				pullUpEl.className = 'loading';
				pullUpEl.querySelector('.pullUpLabel').innerHTML = '向上拉显示更多';				
				pullUpAction();	// Execute custom function (ajax call?)
			}
		}
	});
	
	setTimeout(function () { document.getElementById('wrapper').style.left = '0'; }, 800);
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);
</script>
<style type="text/css" media="all">
/**
 *
 * Pull down styles
 *
 */





#scroller ul {
	list-style: none;
	padding: 0;
	margin: 0;
	width: 100%;
	text-align: left;
}
#myFrame {
	position: absolute;
	top: 15px;
	left: 0;
}
#pullDown, #pullUp {
	background: #fff;
	height: 40px;
	line-height: 40px;
	padding: 5px 10px;
	border-bottom: 1px solid #ccc;
	font-weight: bold;
	font-size: 14px;
	color: #888;
}
#pullDown .pullDownIcon, #pullUp .pullUpIcon {
	display: block;
	float: left;
	width: 40px;
	height: 40px;
	background: url(pull-icon@2x.png) 0 0 no-repeat;
	-webkit-background-size: 40px 80px;
	background-size: 40px 80px;
	-webkit-transition-property: -webkit-transform;
	-webkit-transition-duration: 250ms;
}
#pullDown .pullDownIcon {
	-webkit-transform: rotate(0deg) translateZ(0);
}
#pullUp .pullUpIcon {
	-webkit-transform: rotate(-180deg) translateZ(0);
}
#pullDown.flip .pullDownIcon {
	-webkit-transform: rotate(-180deg) translateZ(0);
}
#pullUp.flip .pullUpIcon {
	-webkit-transform: rotate(0deg) translateZ(0);
}
#pullDown.loading .pullDownIcon, #pullUp.loading .pullUpIcon {
	background-position: 0 100%;
	-webkit-transform: rotate(0deg) translateZ(0);
	-webkit-transition-duration: 0ms;
	-webkit-animation-name: loading;
	-webkit-animation-duration: 2s;
	-webkit-animation-iteration-count: infinite;
	-webkit-animation-timing-function: linear;
}
 @-webkit-keyframes loading {
 from {
-webkit-transform:rotate(0deg) translateZ(0);
}
to {
	-webkit-transform: rotate(360deg) translateZ(0);
}
}
</style>
<script>
 $(document).delegate("#index","pageinit", function() {
	$.mobile.ajaxEnabled=false;
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
</head>
<body <?php body_class(); ?>>
<div data-role="page" id="index">
  <div data-role="header" id="header2"   >
    <h1 id="headerTitle"><a href="#" data-rel="back"><img src="<?php bloginfo('template_url')?>/images/arrowLeft.png" id="newsToggle"></a></h1>
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
<!-- /header -->

<div data-role="content">
