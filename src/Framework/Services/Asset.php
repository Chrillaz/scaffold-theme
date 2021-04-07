<?php

namespace WpTheme\Scaffold\Framework\Services;

use WpTheme\Scaffold\Framework\Services\Storage;

class Asset {

  private $data;

  public function __construct ( Storage $data ) {

    $this->data = $data;
  }

  public function getHandle () {

    return $this->data->get( 'handle' );
  }

  public function getVersion () {

    return $this->data->get( 'version' );
  }

  public function getFile () {

    return $this->data->get( 'file' );
  }

  public function getData ( string $name ) {

    return $this->data->get( $name );
  }

  public function append ( string $key, $value ) {
        
    $this->data->set( $key, $value );  
  }
}