<?php

namespace Chrillaz\WPScaffold\Interfaces;

if ( ! defined( 'ABSPATH' ) ) exit;

use Chrillaz\WPScaffold\Includes\Customizer;

use Chrillaz\WPScaffold\Includes\Loader;

use Chrillaz\WPScaffold\Includes\Assets;

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