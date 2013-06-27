<?php get_header("single"); ?>

<div id="main">
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <h1>
    <?php the_title(); ?>
  </h1>
  <?php twentyten_posted_on(); ?>
  <?php the_content();
  ?>
     <?php endwhile; // end of the loop. ?>
</div>
<!-- /#main-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
