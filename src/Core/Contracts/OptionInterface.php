<?php

namespace WpTheme\Scaffold\Core\Contracts;

interface OptionInterface {

  public function getName (): string;

  public function getDefault ();

  public function getCapability (): string;

  public function getOption ();

  public function get ( string $key );

  public function set ( string $option, $value );

  public function remove ( string $option );
}