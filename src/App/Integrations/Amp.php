<?php

namespace WpTheme\Scaffold\App\Integrations;

use WpTheme\Scaffold\Core\Abstracts\Hooks;

class Amp extends Hooks {

  public function request ( \WP $wp ) {

    //var_dump('<pre>', $wp->request, '</pre>');
  }

  public function register (): void {

    $this->hooks->addAction( 'wp', 'request', $this );

    $this->hooks->load();
  }
}