<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\ServiceContainer;

use WpTheme\Scaffold\Services\Commander;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Providers\ProviderRegistrar;

class Bootstrap {

  public function __construct () {

    $this->dependencies();

    $this->providers();
  }

  /**
   * Initializes the container and registers neccessary services.
   */
  private function dependencies () {

    Theme::getInstance( 
      \wp_get_theme( \get_template() ),
      new FlatStorage()
    );
  }

  /**
   * Sets and unsets the wp actions/filters
   * Maps to Providers namespace.
   */
  private function providers () {

    require __DIR__ . '/Providers/Config.php';

    $command = new Commander();
    $registrar = new ProviderRegistrar();

    foreach ( $providers['unregister'] as $hook => $provider ) {
      
      $registrar->remove( $hook, $provider );
    }

    foreach ( $providers['register'] as $hook => $provider ) {

      $command->setCommand( new $provider( $registrar, $hook ) );
      $command->run();
    }
  }
}