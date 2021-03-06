<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\ServiceContainer;

use WpTheme\Scaffold\Providers\Invoker;

use WpTheme\Scaffold\Providers\Reciever;

use WpTheme\Scaffold\Providers\ServiceProvider;

use WpTheme\Scaffold\Services\Subscriber;

use WpTheme\Scaffold\Services\FlatStorage;

class Bootstrap {

  public function __construct () {

    $this->dependencies();

    $this->services();
  }

  private function dependencies () {

    $container = new ServiceContainer( new FlatStorage() );

    $container->register( Subscriber::class, function( $container ) {
      
      return $container->make( FlatStorage::class, array(
        'actions' => array(),
        'filters' => array()
      ));
    });

    Theme::getInstance( $container, \wp_get_theme( \get_template() ) );
  }

  private function services () {

    require __DIR__ . '/Providers/Config.php';

    $invoker = new Invoker(); // Executor
    $reciever = new Reciever(); // Subscriber

    foreach ( $providers as $provider ) {

      $invoker->setCommand( new $provider( $reciever ) );
      $invoker->run();
    }
  }
}