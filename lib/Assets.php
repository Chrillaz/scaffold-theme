<?php

namespace Theme\Scaffold;

use Theme\Scaffold\Includes\Script;

use Theme\Scaffold\Includes\Style;

class Assets extends Queue {

  private $context;

  public function with ( $value ) {

    $this->context = $value;

    return $this;
  }

  public function add ( string $context, \Closure $callback ) {

    if ( is_object( $callback ) && is_callable( $callback ) ) {

      $this->context = $context;
      $callback::bind( $callback, $this );

      $callback( $this );
    }
  }

  public function script ( string $handle, array $options = [] ): object {

    return $this->queue( $this->context, new Script( $handle, $options ) );
  }

  public function style ( string $handle, array $options = []): object {
    
    return $this->queue( $this->context, new Style( $handle, $options ) );
  }

  public function load (): void {

    array_map( function ( $asset ) {
      
      $asset->enqueue();
      
      unset( $asset );

    }, $this->{$this->context} );
  }

  /**
   * scriptExec
   * 
   * Sets script_execution defer/async
   * 
   * @param string $tag
   * 
   * @param string $handle
   * 
   * @return string
   */
  public function scriptExec ( $tag, $handle ): string {

    $script_exec = wp_scripts()->get_data( $handle, 'script_exec' );

    if ( ! $script_exec ) {

      return $tag;
    }

    foreach ( wp_scripts()->registered as $script ) {

      if ( in_array( $handle, $script->deps, true ) ) {

        return $tag;
      }
    }

    if ( ! preg_match( ":\s$script_exec(=|>|\s):", $tag ) ) {

      $tag = preg_replace( ':(?=></script>):', " $script_exec", $tag, 1 );
    }

    return $tag;
  }
}