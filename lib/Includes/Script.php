<?php

namespace Theme\Scaffold\Includes;

use Theme\Scaffold\Interfaces\IAsset;

class Script implements IAsset {

  private $src;

  private $deps;
  
  private $handle;

  private $version;

  private $args;
  
  private $register;
  
  private $execution;

  private $objectKey;

  private $objectData;

  /**
   *
   * @param string $handle
   * 
   * @param array $args accepts file, dependencies array and infooter
   */
  public function __construct ( string $handle, array $args ) {

    $this->enqueue = true;

    $this->handle = $handle;

    $this->src = get_template_directory_uri() . '/assets/js/' . $args['file'];

    $this->version = filemtime( get_template_directory() . '/assets/js/' . $args['file'] );

    $this->deps = ( isset( $args['dependencies'] ) ? $args['dependencies'] : [] );

    $this->args = ( isset( $args['infooter'] ) ? $args['infooter'] : true );
  }

  public function remove (): Style {

    $this->enqueue = false;

    return $this;
  }

  public function inline ( string $text ): Style {

    $this->inline = $text;

    return $this;
  }

  public function load ( string $execution ): Script {

    if ( 'defer' === $execution || 'async' == $execution ) {

      $this->execution = $execution;
    }

    return $this;
  }

  public function localize ( string $object, array $data ): Script {

    $this->objectKey = $object;

    $this->objectData = $data;

    return $this;
  }

  public function enqueue (): void {
    
    $wpscripts = wp_scripts();

    if ( isset( $wpscripts->registered[$this->handle] ) && ! $this->enqueue ) {

      $wpscripts->dequeue( $this->handle );

      return;
    }
    
    if ( ! isset( $wpscripts->registered[$this->handle] ) ) {
      
      $wpscripts->add( $this->handle, $this->src, $this->deps, $this->version );
    }
    
    if ( isset( $wpscripts->registered[$this->handle] ) && $this->args ) {
        
      $wpscripts->add_data( $this->handle, 'group', 1 );
    }

    if ( isset( $wpscripts->registered[$this->handle] ) && isset( $this->execution ) ) {
      
      $wpscripts->add_data( $this->handle, 'script_exec', $this->execution );
    }

    if ( isset( $wpscripts->registered[$this->handle] ) && ! empty( $this->objectKey ) ) {
        
      $wpscripts->localize( $this->handle, $this->objectKey, $this->objectData );
    }

    $wpscripts->enqueue( $this->handle );
  }
}