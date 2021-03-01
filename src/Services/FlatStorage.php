<?php

namespace WPTheme\Scaffold\Services;

use WPTheme\Scaffold\Contracts\Storage;

final class FlatStorage implements Storage {

  private $storage;

  public function __construct () {

    $this->storage = array();
  }

  public function contains ( $keyOrValue ): bool {

    return ( array_key_exists( $keyOrValue, $this->storage ) || in_array( $keyOrValue, $this->storage ) );
  }

  public function get ( string $key ) {

    if ( $this->contains( $key ) ) {

      return $this->storage[$key];
    }

    return false;
  }

  public function all (): array {

    return $this->storage;
  }

  public function collect ( ...$keys ): array {

    return array_reduce( $keys, function ( $acc, $curr ) {

      if ( $this->contains( $key ) ) {

        array_push( $acc, $this->storage[$curr] );
      }

      return $acc;
    }, array() );
  }

  public function update ( string $key, $value ) {

    $this->storage[$key] = $value;
    
    return $this->get( $key );
  }

  public function delete ( string $key ): bool {

    if ( $this->contains( $key ) ) {
      
      unset( $this->storage[$key] );

      return true;
    }

    return false;
  }

  public function create ( $list ): void {

    $flattened = array();

    foreach ( $list as $key => $item ) {

      if ( is_array( $item ) && ! empty( $item ) ) {

        $flattened = array_merge( $flattened, $this->create( $item ) );
      } else {

        $flattened[$key] = $item;
      }
    }

    $this->storage = $flattened;
  }
}