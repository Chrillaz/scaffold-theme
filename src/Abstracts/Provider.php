<?php

namespace WpTheme\Scaffold\Abstracts;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Providers\ProviderRegistrar;

abstract class Provider {

  protected $theme;

  protected $provider;
  
  protected $hook;

  public function __construct ( Theme $theme, ProviderRegistrar $provider, string $hook ) {

    $this->theme = $theme;

    $this->provider = $provider;

    $this->hook = $hook;
  }

  public function getHook () {

    return $this->hook;
  }

  abstract public function boot ( ...$args );

  abstract public function register ();
}