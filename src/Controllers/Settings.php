<?php

namespace WpTheme\Scaffold\Controllers;

class Settings {

  private $settings;

  private $options;

  public function __construct( $settings, $options ) {

    $this->settings = $settings;

    $this->options = $options;
  }

  public function save () {
    
  }
}