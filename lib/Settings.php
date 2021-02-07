<?php

namespace Theme\Scaffold;

use THeme\Scaffold\Interfaces\ICollection;

class Settings implements ICollection {

  private $settings = [];

  public function __construct ( array $settings ) {

    $this->settings = $settings;
  }

  public function get ( string $property ) {

    if ( isset( $this->settings[$property] ) ) {

      return $this->settings[$property];
    }

    return false;
  }

  public function collect ( ...$properties ) {

    foreach ( $properties as $index => $property ) {

    }
  }

  public function all () {

    return $this->settings;
  }
}