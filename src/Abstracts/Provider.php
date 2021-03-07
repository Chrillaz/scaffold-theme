<?php

namespace WpTheme\Scaffold\Abstracts;

use WpTheme\Scaffold\Theme;

use WpTheme\Scaffold\Providers\ProviderRegistrar;

abstract class Provider {

  protected $registrar;
  
  protected $hook;

  public function __construct ( ProviderRegistrar $registrar, string $hook ) {

    $this->registrar = $registrar;

    $this->hook = $hook;
  }

  public function getHook () {

    return $this->hook;
  }

  abstract public function boot ( ...$args );

  abstract public function register ();
}