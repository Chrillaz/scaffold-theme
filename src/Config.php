<?php

namespace Scaffold\Theme;

return [
  /**
   * Theme bindings
   */
  'bindings' => [
    \WP_Theme::class => function () { return \wp_get_theme( \get_template() ); },
  ],
];