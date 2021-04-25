<?php

namespace WpTheme\Scaffold\Core\Abstracts;

use WpTheme\Scaffold\Core\Contracts\OptionInterface;

abstract class Option implements OptionInterface {

  protected $name;

  protected $capability;

  protected $default;

  public function __construct( string $name, string $capability, $default ) {
  
    $this->name = $name;

    $this->capability = $capability;

    $this->default = $default;
  }

  public function getName (): string {

    return $this->name;
  }

  public function getDefault () {

    return $this->default->all();
  }

  public function getCapability (): string {

    return $this->capability;
  }

  public function getOption () {

    return \wp_parse_args(
      \get_option( $this->getName(), $this->getDefault() ),
      $this->getDefault()
    );
  }

  public function get ( string $key = null ) {

    if ( is_null( $key ) ) {

      return $this->getOption();
    }

    if ( ! is_array( $option = $this->getOption() ) ) {

      throw new \Exception( 'Option is not array' );
    }
    
    if ( array_key_exists( $key, $option ) ) {
      
      return \esc_attr( $option[$key] );
    }

    return false;
  }

  public function set ( string $option, $value ) {

  }

  public function remove ( string $option ) {

  }

  abstract public static function register ( \WpTheme\Scaffold\Core\Theme $theme );
}