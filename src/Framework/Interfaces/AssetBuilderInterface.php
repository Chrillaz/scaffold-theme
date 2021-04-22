<?php

namespace WpTheme\Scaffold\Framework\Interfaces;

interface AssetBuilderInterface {

  public function dequeue (): void;
  
  public function enqueue (): void;
}