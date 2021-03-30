<?php

namespace WpTheme\Scaffold\Providers\Admin;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class SettingsPageProvider extends Provider {

  public function boot ( ...$args ) {

    \add_theme_page( 
      __( 'Theme Options', Theme::get( 'TextDomain' ) ),
      __( 'Theme Options', Theme::get( 'TextDomain' ) ),
      'manage_options', 
      'wordpress_theme_scaffold_options', 
      function () {

        $options = Theme::use( 'ThemeOptions' );

        \ob_start();

        include __DIR__ . '/../../../templates/admin/theme-options-page.php';
        
        echo \ob_get_clean();
      }
    );
  }

  public function register () {

    $this->registrar->action( $this );
  }
}