<?php

namespace WpTheme\Scaffold\Providers\Admin;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class SettingsProvider extends Provider {

  public function boot ( ...$args ) {

    $options = Theme::use( 'ThemeOptions' );

    \register_setting( $options->getName(), 'theme_options' );
  }

  public function register () {

    $this->registrar->action( $this );
  }
}