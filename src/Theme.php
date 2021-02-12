<?php

namespace WPTheme\Scaffold;

use WPTheme\Scaffold\Providers\ServiceProvider;

class Theme extends ServiceProvider {

  public $theme;

  public $name;

  public $version;

  public function __construct () {

    $this->theme = wp_get_theme( get_template() );

		$this->name = $this->theme->get( 'Name' );

		$this->version = $this->theme->get( 'Version' );

		$this->bootstrap( $this );
  }

  public function get ( $header ) {

    return $this->theme->get( $header );
  }
}