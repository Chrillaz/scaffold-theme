<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Services\Asset;

use WpTheme\Scaffold\Services\Style;

use WpTheme\Scaffold\Services\Script;

use WpTheme\Scaffold\Services\Storage;

use WpTheme\Scaffold\Services\Subscriber;

class Theme {

  private $container;

  private $theme;

  private static $instance;

  private function __construct ( array $args ) {

    list ( $theme, $container ) = $args;
    
    $this->container = $container;

    $this->theme = $theme;
  }

  public static function get ( $header ) {

    return self::$instance->theme->get( $header );
  }

  public static function use ( string $service ) {

    return self::$instance->container->get( $service );
  }

  public static function container () {

    return self::$instance->container;
  }

  public static function addScript ( string $handle, string $src = '' ) {

    return new Script( \wp_scripts(), new Asset( new Storage(), $handle, $src ) );
  }

  public static function addStyle ( string $handle, string $src = '' ) {
    
    return new Style( \wp_styles(), new Asset( new Storage(), $handle, $src ) );
  }

  public static function getInstance ( ...$args ) {

    if ( self::$instance === null ) {
      
      self::$instance = new Theme( $args );
    }

    return self::$instance;
  }
}