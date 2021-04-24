<?php

namespace WpTheme\Scaffold\Core\Services;

use WpTheme\Scaffold\Core\Resources\Storage;

use WpTheme\Scaffold\Core\Contracts\OptionInterface;

final class ThemeOption implements OptionInterface {

  private $name;

  private $default;

  public function __construct ( string $name, string $capability, Storage $default ) {
    
    $this->name = $name;

    $this->capability = $capability;

    $this->default = $default;
  }

  public function getName (): string {

    return $this->name;
  }

  public function getCapability (): string {

    return $this->capability;
  }

  public function getDefault () {

    return $this->default->all();
  }

  public function getOption () {

    return \wp_parse_args(
      \get_option( $this->getName(), $this->getDefault() ),
      $this->getDefault()
    );
  }

  public function get ( string $key ) {
    
    if ( array_key_exists( $key, $option = $this->getOption() ) ) {
      
      return \esc_attr( $option[$key] );
    }

    return false;
  }

  public function getGroup ( string $group ): array {

    $found = array_filter( $this->getOption(), function ( $key ) use ( $group ) {

      return false !== strpos( $key, "$group." );
    }, ARRAY_FILTER_USE_KEY );

    return \wp_parse_args( $found, array_filter( $this->getDefault(), function ( $key ) {

      return false !== strpos( $key, "$group." );
    }, ARRAY_FILTER_USE_KEY ) );
  }

  public function set ( string $option, $value ) {

  }

  public function remove ( string $option ) {

  }
}