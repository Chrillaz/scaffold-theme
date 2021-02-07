<?php

namespace Theme\Scaffold\Interfaces;

interface IAsset {

  public function remove (): object;
  
  public function inline ( string $text ): object;

  public function enqueue (): void;
}