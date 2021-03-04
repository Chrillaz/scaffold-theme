<?php

namespace WpTheme\Scaffold\Wrappers;

class Script {

  private $wpstyles;

  public function __construct ( \WP_Styles $wpstyles ) {

    $this->wpstyles = $wpstyles;
  }
}