<?php

namespace WpTheme\Scaffold\Abstracts;

use WpTheme\Scaffold\Contracts\Provider;

use WpTheme\Scaffold\Providers\Reciever;

abstract class ProviderImpl implements Provider {

  protected $provider;
  
  public function __construct ( Reciever $provider ) {

    $this->provider = $provider;
  }
}