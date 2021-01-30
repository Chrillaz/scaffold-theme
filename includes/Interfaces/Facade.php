<?php

namespace Chrillaz\Interfaces;

use Chrillaz\Customizer;

use Chrillaz\Loader;

use Chrillaz\Assets;

interface Facade {

  /**
   * customizer
   * 
   * @param array $defaults
   * 
   * @return Customizer
   */
  public function customizer ( ?array $defaults = [] ): Customizer;

  /**
   * loader
   * 
   * @return Loader
   */
  public function loader (): Loader;

  /**
   * loader
   * 
   * @return Loader
   */
  public function assets (): Assets;
}