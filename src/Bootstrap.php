<?php

namespace WPTheme\Scaffold;

use WPTheme\Scaffold\Theme;

use WPTheme\Scaffold\ServiceContainer;

use WPTheme\Scaffold\Services\FlatStorage;

class Bootstrap {

  public function __construct () {

    $this->container = new ServiceContainer( new FlatStorage() );

    $this->dependencies();
  }

  private function dependencies () {

    $this->theme = $this->container->use( __namespace__ . '\\Theme' );

    $this->subscriber = $this->container->use( __namespace__ . '\\Services\\Subscriber' );
  }
}