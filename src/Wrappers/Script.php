<?php

namespace WpTheme\Scaffold\Wrappers;

use WpTheme\Scaffold\Services\Asset;

use WpTheme\Scaffold\Abstracts\AssetBuilder;

class Script extends AssetBuilder {

  private $scripts;

  private $asset;

  public function __construct ( \WP_Scripts $scripts, Asset $asset ) {

    $this->scripts = $scripts;

    $this->asset = $asset;
  }

  public function localize ( string $objectName, array $object ) {

    $this->asset->append( 'localizeName', $objectName );

    $this->asset->append( 'localizeData', $object );

    return $this;
  }

  public function load ( string $name ) {

    $name = trim( $name );

    if ( in_array( $name, ['defer', 'async'] ) ) {

      $this->asset->append( 'load', $name );
    }

    return $this;
  }

  public function remove () {
    
    $this->scripts->dequeue( $this->asset->getHandle() );
  }

  public function enqueue () {

    if ( ! $this->scripts->registered[$this->asset->getHandle()] ) {

      $this->scripts->add( 
        $this->asset->getHandle(), 
        $this->asset->getFile(), 
        $this->asset->getData( 'dependencies' ), 
        $this->asset->getVersion() 
      );

      if ( $this->asset->getData( 'context' ) === 'footer' ) {

        $this->scripts->add_data( $this->asset->getHanlde(), 'group', 1 );
      }
    }

    if ( $inline = $this->asset->getData( 'inline' ) && $this->scripts->registered[$this->asset->getHandle()] ) {

      $this->scripts->add_inline_script( $this->asset->getHandle(), $inline );
    }

    if ( $name = $this->asset->getData( 'localizeName' ) && $this->scripts->registered[$this->asset->getHanlde()] ) {

      $this->scripts->localize( $this->asset->getHandle(), $name, $this->asset->getData( 'localizeData' ) );
    }

    if ( $exec = $this->asset->getData( 'load' ) && $wp->registered[$this->handle] ) {

      $this->scripts->add_data( $this->asset->getHandle(), 'script_execution', $exec );
    }

    $this->scripts->enqueue( $this->asset->getHandle() );
  }
}