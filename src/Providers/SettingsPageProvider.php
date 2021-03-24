<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class SettingsPageProvider extends Provider {

  public function boot ( ...$args ) {
    
    \add_theme_page( 
      __( 'Theme Options', Theme::get( 'TextDomain' ) ),
      __( 'Theme Options', Theme::get( 'TextDomain' ) ),
      'manage_options', 
      \get_template() . '-options', 
      function () {

        $options = Theme::use( 'ThemeOptions' );

        \ob_start();

        require __DIR__ . '/../../templates/admin/theme-options-page.php';
        
        echo \ob_get_clean();
      }, 
      NULL 
    );
  }

  public function register () {

    $this->registrar->action( $this, 99 );
  }
}