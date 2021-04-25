<?php

namespace WpTheme\Scaffold\Core\Hooks;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Abstracts\Hooks;

use WpTheme\Scaffold\App\Options\ThemeOption;

use WpTheme\Scaffold\Core\Services\HookLoader;

final class OptionPage extends Hooks {

  protected $hooks;

  protected $theme;

  protected $options;

  public function __construct ( HookLoader $hooks, Theme $theme, ThemeOption $options ) {

    $this->hooks = $hooks;

    $this->theme = $theme;

    $this->options = $options;
  }

  public function adminInit () {
  
    \register_setting( $this->options->getName(), $this->options->getName() );
  }

  public function adminMenu () {

    \add_theme_page( 
      __( 'Theme Options', $this->theme->getHeader( 'TextDomain' ) ),
      __( 'Theme Options', $this->theme->getHeader( 'TextDomain' ) ),
      $this->options->getCapability(), 
      $this->options->getName(), 
      function () {
        \get_template_part( 'templates/admin/options', 'page', [
          $this->theme,
          $this->options
        ]);
      },
      null  
    );
  }

  public function register (): void {

    $this->hooks->addAction( 'admin_menu', 'adminMenu', $this );
    
    $this->hooks->addAction( 'admin_init', 'adminInit', $this );

    $this->hooks->load();
  }
}