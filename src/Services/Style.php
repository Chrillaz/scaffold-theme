<?php

namespace WpTheme\Scaffold\Services;

use WpTheme\Scaffold\Services\Asset;

use WpTheme\Scaffold\Abstracts\AssetBuilder;

class Style extends AssetBuilder {

  private $styles;

  private $asset;

  public function __construct ( \WP_Scripts $scripts, Asset $asset ) {

    $this->styles = $scripts;

    $this->asset = $asset;
  }

  public function remove () {

    $this->styles->dequeue( $this->asset->getHandle() );
  }

  public function enqueue () {
    
    if ( ! $this->styles->registered[$this->asset->getHandle()] ) {

      $this->styles->add( 
        $this->asset->getHandle(),
        $this->asset->getFile(), 
        $this->asset->getData( 'dependencies' ), 
        $this->asset->getVersion(), 
        $this->asset->getData( 'context' )
      );
    }

    if ( $inline = $this->asset->getData( 'inline' ) && $this->styles->registered[$this->asset->getHandle()] ) {

      $this->styles->add_inline_style( $this->asset->getHandle(), $inline, $this->asset->getData( 'position' ) );
    }

    $this->styles->enqueue( $this->asset->getHandle() );
  }
}