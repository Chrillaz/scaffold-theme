<?php

namespace WPTheme\Scaffold\Providers;

use WPTheme\Scaffold\Services\Bootstrap;

use WPTheme\Scaffold\Services\Assets;

use WPTheme\Scaffold\Abstractions\Option;

use WPTheme\Scaffold\Services\Settings;

class ServiceProvider {

  private $assets;

  private $settings;

  private $themeMods;

  public function assets () {

    if ( $this->assets === null ) $this->assets = new Assets();

    return $this->assets;
  }

  public function settings () {

    if ( $this->settings === null ) {

      $settings = json_decode( file_get_contents( get_template_directory() . '/settings.json' ), true );

      $this->settings = new Settings( $settings );
    }

    return $this->settings;
  }

  public function mods () {

    if ( $this->themeMods === null ) {
      
      $this->themeMods = new Option( 'theme_mods_' . get_template() . '[settings]', $this->settings()->defaults );
    }

    return $this->themeMods;
  }

  public function bootstrap ( $theme ) {

    if ( ! defined( 'THEME_SCAFFOLDED' ) ) {

      define( 'THEME_SCAFFOLDED', true );

      return new Bootstrap( $theme );
    }
  }
}