<section id="comments" class="comments-area" aria-label="<?php esc_attr_e( 'Post Comments', $textdomain = wp_get_theme()->get( 'TextDomain' ) ); ?>">

  <?php 
    comment_form(); 

    if ( have_comments() ) :

      echo sprintf( '<h3 class="comments-title">%s</h3>',
        __( 'Kommentarer - ' . get_comments_number() . 'st', $textdomain )
      );
      
      wp_list_comments();

      the_comments_pagination([
        'before_page_number' => esc_html__( 'Page ', $textdomain ),
        'mid_size'           => 0,
        'prev_text'          => sprintf( '%s <span class="nav-prev-text">%s</span>',
          'prev',
          esc_html__( 'Older comments', $textdomain )
        ),
        'next_text'          => sprintf( '<span class="nav-next-text">%s</span> %s',
          esc_html__( 'Newer comments', $textdomain ),
          'next'
        ),
      ]);
    endif; 
  ?>
</section>