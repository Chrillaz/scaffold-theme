<?php

namespace WpTheme\Scaffold\Abstracts;

abstract class AssetBuilder  {

  public function dependencies ( ...$dependencies ) {

    $this->asset->append( 'dependencies', $dependencies );

    return $this;
  }

  public function inline ( string $inline ) {

    $this->asset->append( 'inline', $inline );

    return $this;
  }

  public function context ( string $context ) {

    $this->asset->append( 'context', [$context] );

    return $this;
  }

  abstract public function remove();

  abstract public function enqueue ();
}