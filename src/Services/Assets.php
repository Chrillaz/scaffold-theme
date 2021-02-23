<?php

namespace WPTheme\Scaffold\Services;

use WPTheme\Scaffold\Abstractions\Style;

use WPTheme\Scaffold\Abstractions\Script;

class Assets {

  private $customProperties;

  public function script ( $handle, $src ) {

    return new Script( $handle, $src );
  }

  public function style ( $handle, $src ) {

    return new Style( $handle, $src );
  }

  public function doCSSVars ( $collection ) {

    $properties = array_reduce( array_keys( $collection ), function ( $acc, $curr ) use ( $collection ) {

      $selector = explode( '.', $curr, 2 );

      $acc .= "--theme-" . $selector[0] . "-" . $selector[1] . ": " . $collection[$curr] . "; \n";

      return $acc;
    }, '' );

    $this->customProperties = sprintf( ':root{%s}', $properties );
  }

  public function getCSSVars () {

    return $this->customProperties;
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
  public function scriptExec ( $tag, string $handle ): string {

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