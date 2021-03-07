<?php

namespace WpTheme\Scaffold\Services;

class Asset {

  private $data;

  private $handle;

  private $version;

  private $file;

  public function __construct ( FlatStorage $data, string $handle, string $src ) {

    $this->data = $data;

    $this->handle = $handle;

    $this->version = \filemtime( \get_template_directory() . '/assets' . $src );

    $this->file = \get_template_directory_uri() . '/assets' . $src;
  }

  public function getHandle () {

    return $this->handle;
  }

  public function getVersion () {

    return $this->version;
  }

  public function getFile () {

    return $this->file;
  }

  public function getData ( string $name ) {

    return $this->data->get( $name );
  }

  public function append ( string $key, $value ) {
        
    $this->data->update( $key, $value );  
  }
}