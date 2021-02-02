<?php

namespace Chrillaz\WPScaffold\Includes;

use Chrillaz\WPScaffold\Theme;

abstract class Loader extends Theme {

  protected $login = [];
  
  protected $admin = [];
  
  protected $editor = [];
  
  protected $public = [];
  
  protected $actions = [];
  
  protected $filters = [];
  
  /**
   * queue
   * 
   * @param string $queue
   * 
   * @param object $executable
   * 
   * @return void
   */
  public function queue ( string $queue, object $executable ): void {

    array_push( $this->{$queue}, $executable );
  }

  /**
   * load
   * 
   * @return void
   */
  abstract public function load (): void;
}