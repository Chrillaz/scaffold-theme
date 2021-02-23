<?php

namespace WPTheme\Scaffold\Interfaces;

interface Collection {

  public static function set ( string $key, $value );

  public static function get (): array;

  public static function pick ( string $key );

  public static function collect ( ...$keys ): array;

  public static function remove ( string $key ): bool;

  public static function dump ( string $key = null );
}