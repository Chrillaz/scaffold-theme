<?php

namespace WpTheme\Scaffold\Providers;

class ProviderRegistrar {

  public function action ( $provider, int $priority = 10, int $numargs = 1 ) {

    \add_action( 
      $provider->getHook(), 
      [$provider, 'boot'],
      $priority,
      $numargs
     );
  }

  public function filter ( $provider, int $priority = 10, int $numargs = 1 ) {

    \add_filter( 
      $provider->getHook(), 
      [$provider, 'boot'],
      $priority, 
      $numargs
     );
  }

  public function remove ( string $hook, array $args ) {

    \remove_action(
      $hook,
      $args['component'],
      $args['priority'],
      $args['args']
    );
  }
}