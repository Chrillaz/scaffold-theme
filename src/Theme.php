<?php

namespace WpTheme\Scaffold;

use \Essentials\Essentials;

class Theme {

  protected $theme;

  protected $container;

  public function __construct( \WP_Theme $theme, Essentials $container ) {

    $this->theme = $theme;

    $this->container = $container;
  }

  public function container () {

    return $this->container;
  }

  public function get ( string $head ) {

    return $this->theme->get( $head );
  }
}