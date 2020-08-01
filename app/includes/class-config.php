<?php

namespace Theme\includes;

class Config {

  protected static $configMap = [];

  public static function define ( string $name, $value ): void {

    self::defined( $name ) or self::$configMap[$name] = $value;
  }

  public static function get ( string $name ) {

    if ( ! array_key_exists( $name, self::$configMap ) ) {

      throw new \WP_Error( $name . 'is not defined' );
    }

    return self::$configMap[$name];
  }

  public static function remove ( string $name ): void {

    unset( self::$configMap[$name] );
  }

  public static function apply (): void {

    foreach ( self::$configMap as $name => $value ) {

      defined( $name ) or define( $name, $value );
    }
  }
  
  protected static function defined ( string $name ): bool {

    if ( defined( $name ) ) {

      throw new \WP_Error($name . 'is already defined' );
    }

    return false;
  }
}