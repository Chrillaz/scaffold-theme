<?php

namespace Chrillaz\WPScaffold\Includes;

use Chrillaz\WPScaffold\Theme;

abstract class Loader extends Theme {

  protected $actions = [];

  protected $filters = [];

  protected $assets = [];
  
  abstract public function queue ( ...$args );

  abstract public function load (): void;
}