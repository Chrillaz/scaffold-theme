<?php

add_action( 'theme_after_footer', function () {
  ?>
  <section class="footer-info">
    <small class="footer-copy">
      Copyright 
      <?php echo get_bloginfo( 'name' ) . ' &copy; ' . date( 'Y' ); ?>
    </small>
          
    <small>
      Powered by 
      <a href="<?php echo THEME_AUTHOR_URL; ?>" target="_blank">
        <?php echo THEME_AUTHOR; ?>
      </a>
    </small>
  </section><!-- end .footer-info -->
  <?php
}, 10);