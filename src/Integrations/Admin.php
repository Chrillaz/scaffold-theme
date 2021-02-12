<?php

namespace WPTheme\Scaffold\Integrations;

use WPTheme\Scaffold\Interfaces\Integration;

class Admin implements Integration {

  private $theme;

  public function __construct( $theme ) {

    $this->theme = $theme;
  }
}