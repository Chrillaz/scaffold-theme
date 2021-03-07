<?php

namespace WpTheme\Scaffold\Providers;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Abstracts\Provider;

class ScriptexecProvider extends Provider {

  public function boot ( ...$args ) {

    list( $tag, $handle ) = $args;
    
    $script_exec = \wp_scripts()->get_data( $handle, 'script_execution' );
  
    if ( ! $script_exec ) {
  
      return $tag;
    }
  
    foreach ( \wp_scripts()->registered as $script ) {
  
      if ( in_array( $handle, $script->deps, true ) ) {
  
        return $tag;
      }
    }
      
    if ( ! preg_match( ":\s$script_exec(=|>|\s):", $tag ) ) {
  
      $tag = preg_replace( ':(?=></script>):', " $script_exec", $tag, 1 );
    }
  
    return $tag;
  }

  public function register () {

    $this->registrar->action( $this, 10, 2 );
  }
}