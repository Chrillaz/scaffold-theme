<?php

namespace WpTheme\Scaffold\Framework\Interfaces;

interface AssetBuilderInterface {

  public function set ( string $handle, string $file ): void;

  public function enqueue (): void;
}