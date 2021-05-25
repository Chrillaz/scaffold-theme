<?php

namespace Scaffold\Theme\Hooks;

use Scaffold\Theme\Options\CookieOption;

use \Scaffold\Essentials\Abstracts\Hooks;

use \Scaffold\Essentials\Services\HookLoader;

final class CookieBar extends Hooks {

  protected $hooks;

  protected $options;

  public function __construct ( HookLoader $hooks, CookieOption $options ) {

    $this->hooks = $hooks;

    $this->options = $options;
  }

  public function adminInit () {
  
    \register_setting( $this->options->getName(), $this->options->getName() );
  }

  public function adminMenu () {

    \add_options_page( 
      __( 'Noor Cookie Settings', Theme()->get( 'TextDomain' ) ),
      __( 'Noor Cookie Settings', Theme()->get( 'TextDomain' ) ),
      $this->options->getCapability(), 
      $this->options->getName(), 
      function () {
        \get_template_part( 'templates/admin/cookie', 'page', [
          Theme(),
          $this->options
        ]);
      },
      null  
    );
  }

  public function output () {

    echo sprintf('
      <div class="cookie-notice">
        <div>
          <small>%s</small>
          <div>
            <a class="cookie-accept" href="" rel="nofollow">%s</a>
          </div>
        </div>
      </div>',
      $this->options->get( 'content' ),
      $this->options->get( 'buttonText' )
    );
  }

  public function register (): void {

    $this->hooks->addAction( 'admin_menu', 'adminMenu', $this );
    
    $this->hooks->addAction( 'admin_init', 'adminInit', $this );

    $this->hooks->addAction( 'wp_footer', 'output', $this );

    $this->hooks->load();
  }
}