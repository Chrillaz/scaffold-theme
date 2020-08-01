<?php
get_header();
  if (have_posts()) :

    // theme_before_single_content();

    while (have_posts()) : the_post();
      echo the_title();
      the_content();
    endwhile;

    // theme_after_single_content();

  endif;
get_footer();
