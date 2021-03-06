<?php

namespace WpTheme\Scaffold\Contracts;

interface Container {

  public function make ( string $name );

  public function use ( string $name );

  public function register ( string $name, \Closure $callback );
}