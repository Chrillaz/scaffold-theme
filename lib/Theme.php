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

  public function src ( string $relpath = '' ) {

    return (object) [
      'path' => get_template_directory() . $path,
      'uri'  => get_template_directory_uri() . $path
    ];
  }

  public function get ( string $header ) {

    return $this->theme->get( $header );
  }

  public function option () {

  }

  public function options () {

  }

  public function setting ( string $setting ) {

    return $this->settings()->get( $setting );
  }

  public function settings ( ...$settings ) {

    if ( ! empty( $settings = $this->settings()->collect( $settings ) ) ) {

      return $settings;
    }

    return $this->settings()->all();
  }

  public function run () {

    $this->hooks()->load();
  }
}