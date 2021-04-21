<?php

namespace WpTheme\Scaffold\Framework;

final class Theme {

  // private static $instance;

  private $theme;

  public function __construct ( \WP_Theme $theme ) {

    $this->theme = $theme;
  }

  public function get ( string $head ) {

    return $this->theme->get( $head );
  }

  // public static function getInstance () {

  //   if ( is_null( self::$instance ) ) self::$instance = new Theme();

  //   return self::$instance;
  // }
}