<?php

namespace WPTheme\Scaffold\Providers;

use WPTheme\Scaffold\Services\Bootstrap;

class ServiceProvider {

  public function bootstrap ( $theme ) {

    if ( ! defined( 'THEME_SCAFFOLDED' ) ) {

      define( 'THEME_SCAFFOLDED', true );

      return new Bootstrap( $theme );
    }
  }
}