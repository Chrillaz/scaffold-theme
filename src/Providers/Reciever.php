<?php

namespace WpTheme\Scaffold\Providers;

class Reciever {

  public function addAction ( $provider, string $method ) {

    \add_action( 
      $provider->context['hook'], 
      [$provider, $method],
      $provider->context['priority'], 
      $provider->context['acceptedargs']
     );
  }

  public function addFilter ( $provider, string $method ) {

    \add_filter( 
      $provider->context['hook'], 
      [$provider, $method],
      $provider->context['priority'], 
      $provider->context['acceptedargs']
     );
  }
}