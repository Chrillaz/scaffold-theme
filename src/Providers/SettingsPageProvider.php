<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Controllers\Settings;

use WpTheme\Scaffold\Abstracts\Provider;

class SettingsPageProvider extends Provider {

  public function boot ( ...$args ) {

    \add_submenu_page( 
      'themes.php', 
      __( 'theme settings', Theme::get( 'TextDomain' ) ),
      __( 'Theme Settings', Theme::get( 'TextDomain' ) ),
      'manage_options', 
      'theme-settings', 
      function () {

        $options = Theme::use( 'ThemeOptions' );
        
        \ob_start();

        require __DIR__ . '/../../templates/admin/theme-settings.php';
        
        echo \ob_get_clean();
      }, 
      NULL 
    );
  }

  public function register () {

    $this->registrar->action( $this, 99 );
  }
}