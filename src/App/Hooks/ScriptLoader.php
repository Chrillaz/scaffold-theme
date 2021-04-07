<?php

namespace WpTheme\Scaffold\App\Hooks;

use WpTheme\Scaffold\Framework\Abstracts\Hooks;

use WpTheme\Scaffold\Framework\Services\HookLoader;

final class ScriptLoader extends Hooks {

  protected $hooks;

  protected $scripts;

  public function __construct ( HookLoader $hooks, \WP_Scripts $scripts ) {

    $this->hooks = $hooks;

    $this->scripts = $scripts;
  }

  public function scriptExecution ( string $tag, string $handle ) {

    $script_exec = $this->scripts->get_data( $handle, 'script_execution' );
  
    if ( ! $script_exec ) {
  
      return $tag;
    }
  
    foreach ( $this->scripts->registered as $script ) {
  
      if ( in_array( $handle, $script->deps, true ) ) {
  
        return $tag;
      }
    }
      
    if ( ! preg_match( ":\s$script_exec(=|>|\s):", $tag ) ) {
  
      $tag = preg_replace( ':(?=></script>):', " $script_exec", $tag, 1 );
    }
  
    return $tag;
  }

  public function register (): void {

    $this->hooks->addAction( 'script_loader_tag', 'scriptExecution', $this, 10, 2 );

    $this->hooks->load();
  }
}