<?php get_header(); ?>
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

<div id="main">
    <!--轮播开始-->
    <div id='slider' class='swipe'>
      <div class='swipe-wrap'>
        <div><a href="#"><img src="<?php bloginfo('template_url')?>/images/ad1.jpg" /></a></div>
        <div><a href="#"><img src="<?php bloginfo('template_url')?>/images/ad2.jpg" /></a></div>
        <div><a href="#"><img src="<?php bloginfo('template_url')?>/images/ad3.jpg" /></a></div>
        <div><a href="#"><img src="<?php bloginfo('template_url')?>/images/ad4.jpg" /></a></div>
      </div>
    </div>
    <!--位置指示-->
    <nav id="nav">
      <ul id="position">
        <li class="on"></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </nav>
    <!--位置指示--> 
    <!--轮播结束-->
  <?php get_template_part( 'loop', 'index' ); ?>
</div>
<!-- /#main -->

<?php get_footer(); ?>
