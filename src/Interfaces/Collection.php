<?php

namespace WPTheme\Scaffold\Interfaces;

interface Collection {

  public function set ( string $key, $value );

  public function get ();

  public function use ( string $key );

  public function collect ( ...$keys ): array;

  public function remove ( string $key ): bool;

  public function dump ( string $key = null );
}