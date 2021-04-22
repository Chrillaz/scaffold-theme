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

    $asset = $this->theme->makeWith( Asset::class, [
      'handle' => $handle,
      'file'   => $file
    ]);
      
    $script = $this->theme->makeWith( Script::class, [
      'asset' => $asset
    ]);

    $this->add( 'assets', $script );

    return $script;
  }

  public function addStyle ( string $handle, string $file = '' ) {

    $asset = $this->theme->makeWith( Asset::class, [
      'handle' => $handle,
      'file'   => $file
    ]);

    $style = $this->theme->makeWith( Style::class, [
      'asset' => $asset
    ]);

    $this->add( 'assets', $style );

    return $style;
  }

  public function load (): void {

    array_map( function ( $asset ) {

      unset( $asset );
    }, $this->queue->get( 'assets' ) );

    $this->reset();
  } 
}