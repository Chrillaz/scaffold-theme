<?php

namespace WpTheme\Scaffold\Abstracts;

use WpTheme\Scaffold\Services\Asset;

abstract class AssetBuilder  {

  protected $queue;

  protected $asset;

  public function __construct ( $queue, Asset $asset ) {

    $this->queue = $queue;

    $this->asset = $asset;
  }

  public function dependencies ( ...$dependencies ) {

    $this->asset->append( 'dependencies', $dependencies );

    return $this;
  }

  public function inline ( string $inline, string $position = 'after' ) {

    $this->asset->append( 'inline', $inline );

    $this->asset->append( 'position', $position );

    return $this;
  }

  public function context ( string $context ) {

    $this->asset->append( 'context', [$context] );

    return $this;
  }

  public function localize ( string $objectName, array $l10n ) {

    $this->asset->append( 'objectName', $objectName );

    $this->asset->append( 'l10n', $l10n );

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

    $this->queue->dequeue( $this->asset->getHandle() );
  }

  abstract public function enqueue ();
}