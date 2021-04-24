<?php

namespace WpTheme\Scaffold\Core\Abstracts;

use WpTheme\Scaffold\Core\Theme;

use WpTheme\Scaffold\Core\Services\HookLoader;

abstract class Hooks {

  protected $hooks;

  protected $theme;

  public function __construct ( HookLoader $hooks, Theme $theme ) {

    $this->hooks = $hooks;

    $this->theme = $theme;
  }

  abstract public function register (): void;
}