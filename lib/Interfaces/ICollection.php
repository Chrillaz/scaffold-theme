<?php

namespace Theme\Scaffold\Interfaces;

interface ICollection {

  public function get( string $property );

  public function collect( ...$properies ): array;

  public function all(): array;
}