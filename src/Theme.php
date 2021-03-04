<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Wrappers\Hook;

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

  public static function addAction ( ...$args ) {

    self::$instance->container->use( Subscriber::class )->add( 'actions', new Hook( $args ) );
  }

  public static function addFilter ( ...$args ) {

    self::$instance->container->use( Subscriber::class )->add( 'filters', new Hook( $args ) );
  }

  public function subscribe () {

    self::$instance->container->use( Subscriber::class )->subscribe();
  }

  public static function script ( string $handle, string $file ) {

  }

  public static function style ( string $handle, string $file ) {
    
  }

  public static function getInstance ( ServiceContainer $container, \Wp_Theme $theme ) {

    if ( self::$instance === null ) {
      
      self::$instance = new Theme( $container, $theme );
    }

    return self::$instance;
  }
}