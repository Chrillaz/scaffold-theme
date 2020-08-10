<?php
get_header();
if (have_posts()) :
  while (have_posts()) : the_post(); ?>
    <a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a>
  <?php endwhile;
endif;
get_footer();