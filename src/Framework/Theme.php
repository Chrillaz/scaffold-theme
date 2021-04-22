<?php

namespace WpTheme\Scaffold\Framework;

final class Theme {

  private $theme;

  public function __construct ( \WP_Theme $theme ) {

    $this->theme = $theme;
  }

  public function get ( string $head ) {

    return $this->theme->get( $head );
  }
}