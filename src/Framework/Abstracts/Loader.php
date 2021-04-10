<?php

namespace WpTheme\Scaffold\Framework\Abstracts;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Interfaces\LoaderInterface;

abstract class Loader implements LoaderInterface {

  protected $queue;

  public function __construct ( Storage $storage ) {

    $this->queue = $storage;
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