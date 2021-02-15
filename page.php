<?php

get_header();

while ( have_posts() ) : the_post();
  
  get_template_part( 'templates/content/content', get_post_type() );

  if ( comments_open() || get_comments_number() ) {
    
    comments_template();
  }
endwhile;

get_footer();