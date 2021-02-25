<?php

namespace WPTheme\Scaffold\Providers;

use WPTheme\Scaffold\Interfaces\StaticCollection;

class Context implements StaticCollection {

  private static $collection = [];

  public static function set ( string $key, $value ) {

    if ( self::canMerge( $key, $value ) ) {

      self::$collection[$key] = array_merge( self::$collection[$key], $value );
    }

    self::$collection[$key] = $value;
  }

  public static function get (): array {

    return self::$collection;
  }

  public static function use ( string $key ) {

    if ( isset( self::$collection[$key] ) ) {

      return self::$collection[$key];
    }

    return false;
  }

  public static function collect ( ...$keys ): array {

    return array_reduce( $keys, function ( $acc, $curr ) {

      if ( array_key_exists( $curr, self::$collection ) ) {

        $acc[$curr] = self::$collection[$curr];
      }

      return $acc;
    }, array() );
  }

  public static function remove ( string $key ): bool {

    unset( self::$collection[$key] );

    return ! isset( self::$collection[$key] );
  }

  public static function dump ( $key = null ) {

    $key !== null 
      ? var_dump('<pre>', self::use( $key ), '</pre>')
      : var_dump('<pre>', self::get(), '</pre>');
  }

  private static function canMerge ( $key, $value ) {

    return isset( self::$collection[$key] ) && is_array( self::$collection[$key] ) && is_array( $value );
  }
}