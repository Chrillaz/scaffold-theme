<?php

namespace WpTheme\Scaffold\Abstracts;

abstract class Model {

  public function __construct ( $model ) {

    $this->model = $model;
  }
}