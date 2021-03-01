<?php

namespace WPTheme\Scaffold;

class Theme {

  private $theme;

  private $name;

  private $version;

  public function __construct () {

    $this->theme = wp_get_theme( get_template() );

		$this->name = $this->theme->get( 'Name' );

		$this->version = $this->theme->get( 'Version' );
  }

  public function get ( $header ) {

    return $this->theme->get( $header );
  }
}