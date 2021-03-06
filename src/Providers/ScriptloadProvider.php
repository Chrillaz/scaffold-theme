<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Abstracts\ProviderImpl as Provider;

class ScriptloadProvider extends Provider {

  const NAME = 'script_loader_tag';

  public function loader ( string $tag, string $handle ) {

    var_dump('<pre>', 'HELLO LOADER!', '</pre>');
  }

  private function register () {

    $this->provider->addAction( $this, 'loader' );
  }
}