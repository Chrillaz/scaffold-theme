<?php

namespace WpTheme\Scaffold\Framework\Container;

return [
  /**
   * Here we define WP classes that...
   */
  'WP_Theme' => \wp_get_theme( \get_template() ),

  'WP_Scripts' => \wp_scripts(),

  'WP_Styles' => \wp_styles(),
];