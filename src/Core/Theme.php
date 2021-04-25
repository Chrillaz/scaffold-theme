<?php

namespace WpTheme\Scaffold\Core;

use Illuminate\Container\Container;

class Theme extends Container {

  protected static $instance;

  protected $theme;

  private function __construct ( \WP_Theme $theme ) {

    $this->theme = $theme;
  }

  public function getHeader ( string $head ) {

    return $this->theme->get( $head );
  }

  public static function create ( ...$args ) {

    if ( is_null( self::$instance ) ) self::$instance = new Theme( ...$args );

    return self::$instance;
  }
}