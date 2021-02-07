<?php

namespace Theme\Scaffold\Services;

use Theme\Scaffold\Interfaces\ICollection;

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

  public function collect ( ...$properties ): array {

    $chunk = [];

    foreach ( $properties as $index => $property ) {

      if ( isset( $this->settings[$property] ) ) {

        $chunk[$property] = $this->settings[$property];
      }
    }

    return $chunk;
  }

  public function all (): array {

    return $this->settings;
  }
}