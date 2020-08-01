<?php

namespace Theme\includes;

class Route {

  private $path;

  private $hook;

  private $template;

  public function __construct ( string $path, string $hook = '', string $template = '' ) {

    $this->path = $path;
    $this->hook = $hook;
    $this->template = $template;

    $this->reg();
  }

  public function reg () {

    var_dump('<pre>', '^'.ltrim( trim( $this->path ), '/' ).'$', '</pre>');
  }
}
