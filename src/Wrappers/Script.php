<?php

namespace WpTheme\Scaffold\Wrappers;

class Script {

  private $wpscripts;

  public function __construct ( \WP_Scripts $wpscripts ) {

    $this->wpscripts = $wpscripts;
  }
}