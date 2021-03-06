<?php

namespace WpTheme\Scaffold\Abstracts;

use WpTheme\Scaffold\Contracts\Provider;

abstract class ProviderImpl implements Provider {

  protected $provider;

  public function __construct ( ServiceProvider $provider ) {

    $this->provider = $provider;
  }
}