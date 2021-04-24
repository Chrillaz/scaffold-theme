<?php

namespace WpTheme\Scaffold\Core\Resources;

use WpTheme\Scaffold\Core\Resources\Storage;

use WpTheme\Scaffold\Core\Contracts\AssetInterface;

class Asset implements AssetInterface {

  private $data;

  private $handle;

  private $version;

  private $file;

  public function __construct ( Storage $data, $handle, $file ) {

    $this->data = $data;

    $this->handle = $handle;

    if ( ! empty( $file ) ) {

      $this->version = \filemtime( \get_template_directory() . '/assets' . $file );
      
      $this->file = \get_template_directory_uri() . '/assets' . $file;
    }
  }

  public function getHandle (): string {

    return $this->handle;
  }

  public function getVersion (): string {

    return $this->version;
  }

  public function getFile (): string {

    return $this->file;
  }

  public function getData ( string $name ) {

    return $this->data->get( $name );
  }

  public function append ( string $key, $value ): void {
        
    $this->data->set( $key, $value );  
  }
}