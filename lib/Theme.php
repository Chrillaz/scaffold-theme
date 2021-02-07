<?php

namespace Theme\Scaffold;

use Theme\Scaffold\Providers\Facade;

class Theme extends Facade {

  public $theme;

  public $name;

  public $version;

  public function __construct ( string $name ) {

    $this->theme = wp_get_theme( $name );

    $this->name = $this->theme->get( 'Name' );
    
    $this->version = $this->theme->get( 'Version' );

    $this->bootstrap( $this );
  }

  public function run () {

    $this->hooks()->load();
  }
}