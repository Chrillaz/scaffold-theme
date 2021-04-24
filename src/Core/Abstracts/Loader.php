<?php

namespace WpTheme\Scaffold\Core\Abstracts;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Resources\Storage;

use WpTheme\Scaffold\Core\Contracts\LoaderInterface;

abstract class Loader implements LoaderInterface {

  protected $theme;

  public function __construct ( Storage $storage, Theme $theme ) {

    $this->queue = $storage;

    $this->theme = $theme;
  }

  protected function add ( string $queue, $value ): void {

    if ( ! $this->queue->contains( $queue ) ) {

      $this->queue->set( $queue, [] );
    }

    $queued = $this->queue->get( $queue );

    array_push( $queued, $value );

    $this->queue->set( $queue, $queued );
  }

  protected function reset (): void {

    foreach ( $this->queue->all() as $key => $value ) {
      
      $this->queue->delete( $key );
    }
  }

  abstract public function load (): void;
}