<?php

namespace WpTheme\Scaffold\Framework\Services;

use WpTheme\Scaffold\Framework\Resources\{
  Asset,
  Style,
  Script,
  Storage
};

use WpTheme\Scaffold\Framework\Abstracts\Loader;

class AssetLoader extends Loader {

  public function addScript ( string $handle, string $file = '' ) {

    $this->add( 'assets', $script = new Script(
      \wp_scripts(),
      new Asset( new Storage(), $handle, $file )
    ));

    return $script;
  }

  public function addStyle ( string $handle, string $file = '' ) {

    $this->add( 'assets', $style = new Style(
      \wp_styles(),
      new Asset( new Storage(), $handle, $file )
    ));

    return $style;
  }

  public function load (): void {

    array_map( function ( $asset ) {

      unset( $asset );
    }, $this->queue->get( 'assets' ) );

    $this->reset();
  } 
}