<?php

namespace Theme\includes;

class Nav_Menu_Walker extends \Walker_Nav_Menu {

  public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

    return $output;
  }

  public function end_el( &$output, $item, $depth = 0, $args = null ) {

    return $output;
  }
}