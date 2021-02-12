<?php

namespace WPTheme\Scaffold\Services;

use WPTheme\Scaffold\Abstractions\Style;

use WPTheme\Scaffold\Abstractions\Script;

class Assets {

  public function script ( $handle, $src ) {

    return new Script( $handle, $src );
  }

  public function style ( $handle, $src ) {

    return new Style( $handle, $src );
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
  public function scriptExec ( $tag, $handle ): string {

    $script_exec = wp_scripts()->get_data( $handle, 'script_execution' );

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