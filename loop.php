<div id="wrapper">
  <div id="scroller">
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
