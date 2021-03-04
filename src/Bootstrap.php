<?php

namespace WpTheme\Scaffold;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\ServiceContainer;

use WpTheme\Scaffold\Services\Subscriber;

use WpTheme\Scaffold\Services\FlatStorage;

class Bootstrap {

  public function __construct () {

    $this->dependencies();
  }

  private function dependencies () {

    $container = new ServiceContainer( new FlatStorage() );

    $container->register( Subscriber::class, function( $container ) {
      
      return $container->new( FlatStorage::class, array(
        'actions' => array(),
        'filters' => array()
      ));
    });

    Theme::getInstance( $container, wp_get_theme( get_template() ) );
  }
}