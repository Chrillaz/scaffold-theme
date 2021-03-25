<?php

namespace WpTheme\Scaffold\Abstracts;

abstract class Option {

  private $option;

  private $default;
  
  public function __construct ( string $option, $default ) {
    
    $this->option = $option;

    $this->default = $default;
  }

  public function get () {

    return \get_option( $this->option, $this->default->all() );
  }

  public function pick ( ...$keys ) {

    return \array_reduce( $keys, function ( $acc, $curr ) {

      if ( \array_key_exists( $curr, $this->get() ) ) {

        array_push( $acc, $this->get()[$curr] );
      }

      return $acc;
    }, array() );
  }

  public function use ( $key ) {

    if ( isset( $this->get()[$key] ) ) {

      return $this->get()[$key];
    }

    return false;
  }

  public function add ( $value ) {

    \add_option( $this->option, $value );
  }

  public function update ( $value ) {

    \update_option( $this->option, $value );
  }

  public function remove () {

    \delete_option( $this->option );
  }

  public function getName (): string {

    return $this->option;
  }

  public function getDefault () {

    return $this->default->all();
  }
}