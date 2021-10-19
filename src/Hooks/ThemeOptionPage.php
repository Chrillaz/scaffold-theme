<?php

namespace Scaffold\Theme\Hooks;

use Scaffold\Theme\Theme;

use Scaffold\Theme\Options\ThemeOption;

use \Scaffold\Essentials\Abstracts\Hooks;

use \Scaffold\Essentials\Services\HookLoader;

final class ThemeOptionPage extends Hooks 
{

  protected $theme;

  protected $options;

  public function __construct( Theme $theme, ThemeOption $options ) 
  {

    $this->theme = $theme;

    $this->options = $options;
  }

  public function adminInit() 
  {
  
    \register_setting( $this->options->getName(), $this->options->getName() );
  }

  public function adminMenu() 
  {

    \add_theme_page( 
      __( 'Theme Options', $this->theme->get( 'TextDomain' ) ),
      __( 'Theme Options', $this->theme->get( 'TextDomain' ) ),
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

  public function register( HookLoader $hooks ): void 
  {

    $hooks->addAction( 'admin_menu', 'adminMenu', $this );
    
    $hooks->addAction( 'admin_init', 'adminInit', $this );

    $hooks->load();
  }
}