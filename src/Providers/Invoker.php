<?php

namespace WpTheme\Scaffold\Providers;

class Invoker {

  private $command;

  public function setCommand( $cmd ) {

    $this->command = $cmd;
  }

  public function run () {

    $this->command->register();
  }
}