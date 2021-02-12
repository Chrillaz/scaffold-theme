<?php

namespace WPTheme\Scaffold\Services;

class Bootstrap {

  public function __construct ( $theme ) {

    add_action( 'after_setup_theme', function () use ( $theme ) {

      $this->setup( $theme );
    });

    add_action( 'wp_enqueue_scripts', function () use ( $theme ) {

      if ( function_exists( $func = 'publicAssets' ) ) {

        call_user_func_array( $func, [$theme] );
      }
    });

    // $this->integrations( $theme, /* integrations */ );
  }

  private function integrations ( $theme, $integrations ) {

    Integrations::create( $theme, $integrations );
  }

  public function setup ( $theme ) {


  }
}