<?php

namespace WpTheme\Scaffold\Framework\Interfaces;

interface HookLoaderInterface {

  public function addAction ( ...$args ): void;

  public function addFilter ( ...$args ): void;

  public function run(): void;
}