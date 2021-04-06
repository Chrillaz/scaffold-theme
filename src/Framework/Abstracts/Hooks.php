<?php

namespace WpTheme\Scaffold\Framework\Abstracts;

use WpTheme\Scaffold\Framework\Services\HookLoader;

abstract class Hooks {

  public function __construct ( HookLoader $hooks ) {

    $this->hooks = $hooks;
  }

  abstract public function register (): void;
}