<?php

namespace Theme\Scaffold\Providers;

use Theme\Scaffold\Theme;

use Theme\Scaffold\Services\Hooks;

use Theme\Scaffold\Services\Assets;

use Theme\Scaffold\Services\Settings;

use Theme\Scaffold\Services\Bootstrap;

class Facade {

  private $hooks;

  private $assets;

  private $settings;

  public function hooks (): Hooks {

    if ( $this->hooks === null ) $this->hooks = new Hooks();

    return $this->hooks;
  }

  public function assets (): Assets {

    if ( $this->assets === null ) $this->assets = new Assets();

    return $this->assets;
  }

  public function settings (): Settings {

    if ( $this->settings === null ) {

      $settings = json_decode( file_get_contents( __DIR__ . '../../../settings.json' ), true );

      $this->settings = new Settings( $settings );
    }

    return $this->settings;
  }

  public function bootstrap ( Theme $theme ) {

    if ( ! defined( 'THEME_SCAFFOLDED' ) ) {

      define( 'THEME_SCAFFOLDED', true );

      new Bootstrap( $theme );
    }
  }
}