<?php

namespace WpTheme\Scaffold\Core\Contracts;

interface HookInterface {

  public function getAction(): string;

  public function getCallback();

  public function getPriority(): int;

  public function getNumArgs(): int;
}