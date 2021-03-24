<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class SettingsProvider extends Provider {

  public function boot ( ...$args ) {

    $settings = Theme::use( 'ThemeOptions' );
    
    foreach ( $settings->getDefault()->all() as $setting => $value ) {

      \register_setting( \get_template() . '-options', $setting, array( 'default' => $value ) );
    }
  }

  public function register () {

    $this->registrar->action( $this );
  }
}