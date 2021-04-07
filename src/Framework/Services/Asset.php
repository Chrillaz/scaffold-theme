<?php

namespace WpTheme\Scaffold\Framework\Services;

use WpTheme\Scaffold\Framework\Services\Storage;

use WpTheme\Scaffold\Framework\Interfaces\AssetInterface;

class Asset implements AssetInterface {

  private $data;

  public function __construct ( Storage $data ) {

    $this->data = $data;
  }

  public function set ( string $handle, string $file ): void {

    $this->append( 'handle', $handle );

    if ( ! empty( $file ) ) {

      $this->append( 'version', \filemtime( \get_template_directory() . '/assets' . $file ) );
      
      $this->append( 'file', \get_template_directory_uri() . '/assets' . $file );
    }
  }

  public function getHandle (): string {

    return $this->data->get( 'handle' );
  }

  public function getVersion (): string {

    return $this->data->get( 'version' );
  }

  public function getFile (): string {

    return $this->data->get( 'file' );
  }

  public function getData ( string $name ) {

    return $this->data->get( $name );
  }

  public function append ( string $key, $value ): void {
        
    $this->data->set( $key, $value );  
  }
}