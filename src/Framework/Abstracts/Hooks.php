<?php

namespace WpTheme\Scaffold\Framework\Abstracts;

use WpTheme\Scaffold\Framework\Theme;

use WpTheme\Scaffold\Framework\Services\HookLoader;

abstract class Hooks {

  protected $hooks;

  protected $theme;

  public function __construct ( HookLoader $hooks, Theme $theme ) {

    $this->hooks = $hooks;

    $this->theme = $theme;
  }

  abstract public function register (): void;
}