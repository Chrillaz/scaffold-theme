<?php

namespace WPTheme\Scaffold\Abstractions;

use WPTheme\Scaffold\Interfaces\Collection;

class Option implements Collection {

  private $name;
  
  private $defaults;
  
  private $option;

  public function __construct( $name, $defaults ) {

    $this->name = $name;

    $this->defaults = $defaults;

    $this->option = $this->get();
  }

  public function set ( string $key, $value ) {

    $this->option[$key] = $value;
    
    $update = update_option( $this->name, $this->option );

    if ( $update !== false ) {

      $this->option = $this->get();
    }
  }

  public function get () {
    
    return get_option( $this->name, $this->defaults );
  }

  public function use ( string $key ) {
    
    if ( isset( $this->option[$key] ) ) {

      return $this->option[$key];
    }

    return false;
  }

  public function collect ( ...$keys ): array {

    return array_reduce( $keys, function ( $acc, $curr ) {

      if ( array_key_exists( $curr, self::$collection ) ) {

        $acc[$curr] = self::$collection[$curr];
      }

      return $acc;
    }, array() );
  }

  public function remove ( string $key ): bool {

    unset( $this->option[$key] );

    if ( update_option( $this->name, $this->option ) !== false ) {

      $this->option = $this->get();
    }
  }

  public function dump ( string $key = null ) {

    $key !== null
      ? var_dump('<pre>', $this->use( $key ), '</pre>')
      : var_dump('<pre>', $this->get(), '</pre>');
  }
}