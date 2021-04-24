<?php

namespace WpTheme\Scaffold\Core\Contracts;

interface AssetBuilderInterface {

  public function dequeue (): void;
  
  public function enqueue (): void;
}