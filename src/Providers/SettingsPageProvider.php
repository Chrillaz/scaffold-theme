<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Controllers\Settings;

use WpTheme\Scaffold\Abstracts\Provider;

class SettingsPageProvider extends Provider {

  public function view () {
    
    $settings = new Settings( new FlatStorage( Theme::storage()->get( 'settings' ) ) );
    
    \ob_start();

    require TEMPLATEPATH . '/templates/admin/theme-settings.php';

    $content = \ob_get_clean();

    echo $content;
  }

  public function boot ( ...$args ) {

    \add_submenu_page( 
      'themes.php', 
      __( 'theme settings', Theme::get( 'TextDomain' ) ),
      __( 'Theme Settings', Theme::get( 'TextDomain' ) ),
      'manage_options', 
      'theme-settings', 
      [$this, 'view'], 
      NULL 
    );
  }

  public function register () {

    $this->registrar->action( $this, 99 );
  }
}