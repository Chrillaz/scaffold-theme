<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Abstracts\ProviderImpl as Provider;

class SetupProvider extends Provider {

  const TYPE = 'action';

  const NAME = 'after_setup_theme';

  public function register () {

    $this->provider->register( $this, 'setup' );
  }
}