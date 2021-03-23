<?php

namespace WpTheme\Scaffold\Abstracts;

abstract class Option {

  private $option;

  private $default;
  
  public function __construct ( string $option, $default ) {
    
    $this->option = $option;

    $this->default = $default;
  }

  protected function get () {

    \get_option( $this->option, $this->default );
  }

  protected function add ( $value ) {

    \add_option( $this->option, $value );
  }

  protected function update ( $value ) {

    \update_option( $this->option, $value );
  }

  protected function remove () {

    \delete_option( $this->option );
  }

  public function getName (): string {

    return $this->option;
  }

  public function getDefault () {

    return $this->default;
  }
}