<?php

namespace WPTheme\Scaffold\Providers;

use WPTheme\Scaffold\Services\Bootstrap;

use WPTheme\Scaffold\Services\Assets;

use WPTheme\Scaffold\Services\Settings;

class ServiceProvider {

  private $assets;

  private $settings;

  public function assets () {

    if ( $this->assets === null ) $this->assets = new Assets();

    return $this->assets;
  }

  public function settings() {

    if ( $this->settings === null ) {

      $settings = json_decode( file_get_contents( get_template_directory() . '/settings.json' ), true );

      $this->settings = new Settings( $settings );
    }

    return $this->settings;
  }

  public function bootstrap ( $theme ) {

    if ( ! defined( 'THEME_SCAFFOLDED' ) ) {

      define( 'THEME_SCAFFOLDED', true );

      return new Bootstrap( $theme );
    }
  }
}