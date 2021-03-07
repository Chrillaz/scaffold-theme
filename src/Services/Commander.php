<?php

namespace WpTheme\Scaffold\Services;

class Commander {

  private $command;

  public function setCommand( $cmd ) {

    $this->command = $cmd;
  }

  public function run () {

    $this->command->register();
  }
}