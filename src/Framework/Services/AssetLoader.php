<?php

namespace WpTheme\Scaffold\Framework\Services;

use WpTheme\Scaffold\Framework\Abstracts\Loader;

class AssetLoader extends Loader {

  public function addScript ( string $handle, string $file = '' ) {

    $script = $this->container->get( 'Script' );
    
    $script->set( $handle, $file );

    return $script;
  }

  public function addStyle ( string $handle, string $file = '' ) {

    $script = $this->container->get( 'Style' );
    
    $script->set( $handle, $file );

    return $script;
  }

  public function load (): void {

  } 
}