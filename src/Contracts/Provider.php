<?php

namespace WpTheme\Scaffold\Contracts;

interface Provider {

  public function addAction ( $provider, string $method );

  public function addFilter ( $provider, string $method );
}