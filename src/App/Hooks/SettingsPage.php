<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Theme;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

use WpTheme\Scaffold\Framework\Services\HookLoader;

use WpTheme\Scaffold\Framework\Container\Container;

final class SettingsPage extends Hooks {

  protected $hooks;

  protected $theme;

  protected $container;

  public function __construct ( HookLoader $hooks, Theme $theme, Container $container ) {

    $this->hooks = $hooks;

    $this->theme = $theme;

    $this->container = $container;
  }

  public function adminInit () {
    
    \register_setting( 'theme_option', 'theme_option' );;
  }

  public function adminMenu () {
    
    \add_theme_page( 
      __( 'Theme Options', $this->theme::get( 'TextDomain' ) ),
      __( 'Theme Options', $this->theme::get( 'TextDomain' ) ),
      'manage_options', 
      'theme_option_page', 
      function () {
        \get_template_part( 'templates/admin/options', 'page', [
          $this->theme,
          $this->container->get( 'ThemeOption' )
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