<?php

namespace Theme\Scaffold\Interfaces;

interface ICollection {

  public function get( string $property );

  public function collect( array $properies ): array;

  public function all(): array;
}