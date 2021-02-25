<?php

namespace WPTheme\Scaffold\Services;

class CustomProperties {

  private $customProperties;

  public function __construct( $defaults, $option ) {

    $this->customProperties = $this->generate( $defaults, $option );
  }

  public function generate ( $defaults, $option ) {

    $properties = array_reduce( array_keys( $defaults ), function ( $acc, $curr ) use ( $option ) {

      $selector = explode( '.', $curr, 2 );

      $acc .= "--theme-" . $selector[0] . "-" . $selector[1] . ": " . $option->use( $curr ) . "; \n";

      return $acc;
    }, '' );

    return sprintf( ':root{%s}', $properties );
  }

  public function get () {

    return $this->customProperties;
  }
}