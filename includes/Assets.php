<?php

namespace Chrillaz;

class Assets {

  private $queue;

  public function __construct () {

    $this->queue = [];
  }

  /**
   * assetPath
   * 
   * Returns path to assets
   * 
   * @return string
   */
  public function path ( string $relpath ): object {

    $path = new \stdClass();

    $path->path = get_template_directory() . $relpath;

    $path->uri = get_template_directory_uri() . $relpath;

    return $path;
  }

  /**
   * addScript
   * 
   * wrapper for register, add data and enqueue scripts
   * 
   * @param string $handle
   * 
   * @param array $args
   * 
   * @return mixed
   */
  public function addScript ( string $handle, array $args ) {

    wp_register_script( $handle, $args['src']->uri, $args['dependencies'], filemtime( $args['src']->path ), $args['infooter'] );

    wp_script_add_data( $handle, 'script_execution', $args['scriptexec'] );

    return wp_enqueue_script( $handle );
  }

  /**
   * addStyle
   * 
   * wrapper for register and enqueue styles
   * 
   * @param string $handle
   * 
   * @param array $args
   * 
   * @return mixed
   */
  public function addStyle ( string $handle, array $args ) {

    wp_register_style( $handle, $args['src']->uri, $args['dependencies'], filemtime( $args['src']->path ), $args['media'] );

    return wp_enqueue_style( $handle );
  }

  /**
   * loadAssets
   * 
   * Itterates assets queue and runs all callbacks
   * 
   * @return void
   */
  public function loadAssets (): void {

    array_map( function ( $callback ) {

      if ( is_object( $callback ) && is_callable( $callback) ) {
  
        call_user_func_array( $callback, [ $this ] );
      }
    }, $this->queue );
  }

  /**
   * enqueue
   * 
   * adds callback to queue
   * 
   * @param closure
   * 
   * @return void
   */
  public function enqueue ( \closure $callback ): void {

    array_push( $this->queue, $callback );
  }
 
  /**
   * scriptLoaderTag
   * 
   * Sets script_execution defer/async
   * 
   * @param string $tag
   * 
   * @param string $handle
   * 
   * @return string
   */
  public function scriptLoaderTag ( $tag, $handle ): string {

    $script_exec = wp_scripts()->get_data( $handle, 'script_execution' );

    if ( ! $script_exec ) {

      return $tag;
    }

    if ( 'async' !== $script_exec && 'defer' !== $script_exec ) {

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