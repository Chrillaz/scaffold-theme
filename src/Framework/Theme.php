<?php

namespace WpTheme\Scaffold\Framework;

final class Theme {

  private static $instance;

  private $theme;

  private function __construct () {

    $this->theme = \wp_get_theme( \get_template() );
  }

  public static function get ( string $head ) {

    return self::$instance->theme->get( $head );
  }

  public static function getInstance () {

    if ( is_null( self::$instance ) ) self::$instance = new Theme();

    return self::$instance;
  }
}