<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Abstracts\ProviderImpl as Provider;

class SetupProvider extends Provider {

  public $context = [
    'hook' => 'after_setup_theme',
    'priority' => 10,
    'acceptedargs' => 1
  ];

  public function setup () {

    var_dump('<pre>', 'HELLO SETUP!', '</pre>');
  }

  public function register () {

    $this->provider->addAction( $this, 'setup' );
  }
}