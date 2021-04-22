<?php

namespace WpTheme\Scaffold\Framework;

use Illuminate\Container\Container;

class Theme extends Container {

  private $theme;

  public function __construct ( \WP_Theme $theme ) {

    $this->theme = $theme;
  }

  public function getHeader ( string $head ) {

    return $this->theme->get( $head );
  }
}