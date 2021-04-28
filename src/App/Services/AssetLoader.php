<?php

namespace WpTheme\Scaffold\App\Services;

use WpTheme\Scaffold\Core\Resources\{
  Asset,
  Style,
  Script
};

use WpTheme\Scaffold\Core\Abstracts\Loader;

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