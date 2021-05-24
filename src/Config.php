<?php

namespace WpTheme\Scaffold;

return [
  /**
   * Theme bindings
   */
  'bindings' => [
    \WP_Theme::class => function () { return \wp_get_theme( \get_template() ); },
  ],
];