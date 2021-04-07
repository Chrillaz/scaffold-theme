<?php

namespace WpTheme\Scaffold\Framework\Interfaces;

interface OptionInterface {

  public function getName (): string;

  public function getDefault ();

  public function getOption ();

  public function get ( string $key );

  public function set ( string $option, $value );

  public function remove ( string $option );
}