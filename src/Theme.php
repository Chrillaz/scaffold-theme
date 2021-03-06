<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Wrappers\Hook;

use WpTheme\Scaffold\Wrappers\Style;

use WpTheme\Scaffold\Wrappers\Script;

use WpTheme\Scaffold\ServiceContainer;

use WpTheme\Scaffold\Services\Subscriber;

class Theme {

  private $container;

  private $theme;

  private static $instance;

  private function __construct ( ServiceContainer $container, \WP_Theme $theme ) {

    $this->container = $container;

    $this->theme = $theme;
  }

  public static function get ( $header ) {

    return self::$instance->theme->get( $header );
  }

  public static function container () {

    return self::$instance->container;
  }

  public static function addScript ( string $handle, string $file ) {

    return self::$instance->container->make( Script::class, [
      \wp_scripts(),
      $handle,
      $file
    ] );
  }

  public static function addStyle ( string $handle, string $file ) {
    
    return self::$instance->container->make( Style::class, [
      \wp_styles(),
      $handle,
      $file
    ] );
  }

  public static function getInstance ( ServiceContainer $container, \Wp_Theme $theme ) {

    if ( self::$instance === null ) {
      
      self::$instance = new Theme( $container, $theme );
    }

    return self::$instance;
  }
}