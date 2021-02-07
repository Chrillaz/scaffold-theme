<?php

namespace Theme\Scaffold;

use Theme\Scaffold\Theme;

use Theme\Scaffold\Facade;

use Theme\Scaffold\Integrations\Integrations;

class Bootstrap extends Facade {

  private $theme;

  public function __construct ( Theme $theme ) {

    $this->theme = $theme;

    $theme->hooks()->addAction( 'after_setup_theme', 'setup', $this );
    // Customizer | Settings page
    
    $theme->hooks()->addAction( 'wp_enqueue_scripts', 'load', $theme->assets()->with( 'public' ) );

    $theme->hooks()->addAction( 'script_loader_tag', 'scriptExec', $theme->assets(), 10, 2 );

    $this->integrations();
  }

  public function integrations () {

    Integrations::load();
  }

  public function setup () {
    
  }
}