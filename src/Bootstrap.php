<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\ServiceContainer;

use WpTheme\Scaffold\Services\Commander;

use WpTheme\Scaffold\Services\FlatStorage;

use WpTheme\Scaffold\Providers\ProviderRegistrar;

class Bootstrap {

  private $theme;

  private $container;

  public function __construct () {

    $this->dependencies();

    $this->providers();
  }

  private function dependencies () {

    $this->container = $container = new ServiceContainer( new FlatStorage() );

    $this->theme = Theme::getInstance( $this->container, \wp_get_theme( \get_template() ) );
  }

  private function providers () {

    require __DIR__ . '/Providers/Config.php';

    $command = new Commander();
    $registrar = new ProviderRegistrar();

    foreach ( $providers as $hook => $service ) {

      $command->setCommand( new $service( $this->theme, $registrar, $hook ) );
      $command->run();
    }
  }
}