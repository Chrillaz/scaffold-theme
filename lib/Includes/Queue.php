<?php

namespace Theme\Scaffold\Includes;

abstract class Queue {

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
  protected function queue ( string $queue, object $executable ): object {

    array_push( $this->{$queue}, $executable );

    return $executable;
  }

  /**
   * load
   * 
   * @return void
   */
  abstract public function load (): void;
}