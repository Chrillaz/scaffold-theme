<?php

namespace WpTheme\Scaffold\Framework\Interfaces;

interface HookInterface {

  public function set( array $args ): HookInterface;
}