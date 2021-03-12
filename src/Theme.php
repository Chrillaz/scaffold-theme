<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Services\Asset;

use WpTheme\Scaffold\Services\Style;

use WpTheme\Scaffold\Services\Script;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Services\Subscriber;

class Theme {

  private $storage;

  private $theme;

  private static $instance;

  private function __construct ( array $args ) {

    list ( $theme, $storage ) = $args;
    
    $this->storage = $storage;

    $this->theme = $theme;
  }

  public static function get ( $header ) {

    return self::$instance->theme->get( $header );
  }

  public static function storage () {

    return self::$instance->storage;
  }

  public static function addScript ( string $handle, string $src ) {

    return new Script( \wp_scripts(), new Asset( new FlatStorage(), $handle, $src ) );
  }

  public static function addStyle ( string $handle, string $src ) {
    
    return new Style( \wp_styles(), new Asset( new FlatStorage(), $handle, $src ) );
  }

  public static function getInstance ( ...$args ) {

    if ( self::$instance === null ) {
      
      self::$instance = new Theme( $args );
    }

    return self::$instance;
  }
}