<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Abstracts\ProviderImpl as Provider;

class ScriptloadProvider extends Provider {

  public $context = [
    'hook' => 'script_loader_tag',
    'priority' => 10,
    'acceptedargs' => 2
  ];

  public function loader ( string $tag, string $handle ) {

    var_dump('<pre>', 'HELLO LOADER!', '</pre>');
  }

  public function register () {

    $this->provider->addAction( $this, 'loader' );
  }
}