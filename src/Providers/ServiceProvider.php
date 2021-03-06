<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Contracts\Provider;

class ServiceProvider implements Provider {

  public function addAction ( $provider, string $method ) {

    \add_action( $provider->NAME, [ $provider, $method ], 10, 2 );
  }

  public function addFilter ( $provider, string $method ) {

  }
}