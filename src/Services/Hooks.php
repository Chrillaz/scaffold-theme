<?php

namespace WpTheme\Scaffold\Services;

class Hooks {

  private $hook;

  private $config;

  public function __construct ( array $config ) {

    $this->config = $config;
  }

  public function get ( string $key ) {

    return $this->config[$key];
  }

  public function set( $provider ) {

    $this->hook = $provider;
  }

  public function run () {

    $this->hook->register();
  }
}