<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Theme;

use WpTheme\Scaffold\App\Options\ThemeOption;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

use WpTheme\Scaffold\Framework\Services\HookLoader;

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
      __( 'Theme Options', $this->theme::get( 'TextDomain' ) ),
      __( 'Theme Options', $this->theme::get( 'TextDomain' ) ),
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