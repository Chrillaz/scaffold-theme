<?php

namespace WpTheme\Scaffold\Services;

use WpTheme\Scaffold\Abstracts\AssetBuilder;

class Style extends AssetBuilder {

  public function enqueue () {
    
    if ( ! isset( $this->queue->registered[$this->asset->getHandle()] ) ) {

      $this->queue->add( 
        $this->asset->getHandle(),
        $this->asset->getFile(), 
        $this->asset->getData( 'dependencies' ), 
        $this->asset->getVersion(), 
        $this->asset->getData( 'context' )
      );
    }

    if ( $inline = $this->asset->getData( 'inline' ) && isset( $this->queue->registered[$this->asset->getHandle()] ) ) {

      $this->queue->add_inline_style( $this->asset->getHandle(), $inline, $this->asset->getData( 'position' ) );
    }

    $this->queue->enqueue( $this->asset->getHandle() );
  }
}