<?php

namespace WpTheme\Scaffold\Framework\Interfaces;

interface AssetInterface {

  public function getHandle (): string;

  public function getVersion (): string;

  public function getFile (): string;

  public function getData ( string $name );

  public function append ( string $key, $value ): void;
}