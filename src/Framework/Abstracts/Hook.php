<?php

namespace WpTheme\Scaffold\Framework\Abstracts;

use WpTheme\Scaffold\Framework\Storage;

abstract class Hook {

  public function __construct ( Storage $storage ) {

    $this->storage = $storage;
  }
}