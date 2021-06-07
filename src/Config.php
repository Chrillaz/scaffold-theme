<?php

namespace Scaffold\Theme;

return [
  /**
   * Theme bindings
   */
  'bindings' => [
    \WP_Theme::class => function () { return \wp_get_theme( \get_template() ); },
  ],
   /**
   * Option config
   */
  'option.theme.name'        => 'theme_option',
  'option.theme.capability'  => 'edit_themes',
  'option.cookie.name'       => 'scaffold_cookie',
  'option.cookie.capability' => 'edit_posts',
  /**
   * Theme Global Styles
   */
  'theme.styles' => [
    /**
     * Theme Breakpoints
     */
    'media.sm' => '414',
    'media.md' => '768',
    'media.lg' => '992',
    'media.xl' => '1200',
    /**
     * Theme Color Palette
     */
    'color.dark'            => '#232323',
    'color.primary-dark'    => '#31505E',
    'color.primary'         => '#446B7E',
    'color.primary-light'   => '#D2DCE0',
    'color.secondary-dark'  => '#ECE0D1',
    'color.secondary'       => '#F5EFE8',
    'color.secondary-light' => '#EEEEEE',
    'color.light'           => '#FFFFFF',
    /**
     * Theme Font Sizes
     */
    'font.anchor'    => '12',
    'font.paragraph' => '16',
    'font.h6'        => '20',
    'font.h5'        => '24',
    'font.h4'        => '28',
    'font.h3'        => '32',
    'font.h2'        => '36',
    'font.h1'        => '40'
  ],
  /**
   * Theme Supports
   */
  'theme.supports' => [
    'block-styles'              => true,
    'editor-styles'             => true,
    'align-wide'                => true,
    'responsive-embeds'         => true,
    'disable-custom-colors'     => true,
    'disable-custom-gradients'  => true,
    'disable-custom-font-sizes' => false,
    'px-or-rem-unit'            => false
  ]
];