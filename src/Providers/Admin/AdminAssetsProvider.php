<?php

namespace WpTheme\Scaffold\Providers\Admin;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class AdminAssetsProvider extends Provider {

  public function boot ( ...$args ) {

    if ( 'appearance_page_wordpress_theme_scaffold_options' === $args[0] ) {

      Theme::addScript( 'scaffold-options', '/js/admin-scripts.min.js' )->dependencies( 'jquery', 'wp-color-picker' )->enqueue();

      Theme::addStyle( 'scaffold-options', '/css/admin-styles.css' )->enqueue();
      
      Theme::addStyle( 'wp-color-picker' )->enqueue();
    }
  }

  public function register () {

    $this->registrar->action( $this );
  }
}