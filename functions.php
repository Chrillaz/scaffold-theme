<?php

$theme = require __DIR__ . '/src/Bootstrap.php';

function Theme () {

  global $app;

  return $app->make( \Scaffold\Theme\Theme::class );
}

$cache = Theme()->container()->make(\Scaffold\Essentials\Contracts\CacheInterface::class);

$cache->set( 'test', 'hej', 'testgroup' );

var_dump('<pre>', $cache, '</pre>');