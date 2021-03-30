<?php

namespace WpTheme\Scaffold\Providers\App;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class PublicAssetsProvider extends Provider {

  public function boot ( ...$args ) {
    
    Theme::addScript( 'main', '/js/main.min.js' )->load( 'defer' )->localize('test', ['test' => 'hej hej'])->enqueue();

    // Theme::addStyle( 'main', 'style.css' )->enqueue();
  }

  public function register () {

    $this->registrar->action( $this );
  }
}