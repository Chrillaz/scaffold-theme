<?php

add_action( 'theme_before_content', function () {
  
  if ( has_nav_menu( 'primary_navigation' ) ) {
    ?>
    <nav class="navigation">
      <div class="navigation-wrapper">

        <?php if ( has_custom_logo() ) {

          the_custom_logo();
        }

        wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'container'      => false,
          'items_wrap'     => '',
          'walker'         => new \Theme\includes\Nav_Menu_Walker()
        ]); ?>

      </div><!--- end .navigation-wrapper -->
    </nav><!-- end .navigation -->
    <?php
  }
}, 20);
