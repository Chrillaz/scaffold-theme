<?php

namespace WPTheme\Scaffold\Services;

class Settings {

  public $defaults;

  private $settings = [];

  public function __construct ( $settings ) {

    $this->settings = $settings;

    $this->defaults = $this->doDefaults( 'settings' );
  }

  private function doDefaults ( string $settings ) {

    return array_reduce( $this->get( $settings ), function ( $acc, $curr ) {

      if ( is_array( $curr ) ) {

        $acc = array_merge( $acc, $curr );
      }

      return $acc;
    }, array() );
  }

  public function get ( string $option ) {

    $path = explode( '.', trim( $option ) );

    $value = $this->settings;

    foreach ( $path as $key ) {

      if ( isset( $value[$key] ) ) {

        $value = $value[$key];
      }
    }

    return $value;
  }
}
