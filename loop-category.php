<div id="wrapper">
  <div id="scroller">
      <!--轮播开始-->
    <div id='slider' class='swipe'>
      <div class='swipe-wrap'>
        <div><a href="#"><img src="<?php bloginfo('template_url')?>/images/ad1.jpg" /></a></div>
        <div><a href="#"><img src="<?php bloginfo('template_url')?>/images/ad2.jpg" /></a></div>
        <div><a href="#"><img src="<?php bloginfo('template_url')?>/images/ad3.jpg" /></a></div>
      </div>
    </div>
    <!--位置指示-->
    <nav id="nav">
      <ul id="position">
        <li class="on"></li>
        <li></li>
        <li></li>
      </ul>
    </nav>
    <!--位置指示--> 
    <!--轮播结束-->
    <ul data-role="listview" data-inset="false"  data-icon="false" id="thelist">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <li><a href="<?php the_permalink() ?>" data-transition="slide"> <?php the_post_thumbnail(); ?>
            <h2><?php the_title(); ?></h2>
            <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 75,"...",'utf-8'); ?></p>
            </a> </li>
      <?php endwhile;endif ?>
    </ul>

  </div>
</div>
