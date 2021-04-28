<?php

namespace WpTheme\Scaffold\App\Config;

return [
  /**
   * Theme bindings
   */
  'theme.bindings' => [
    '\\WP_Theme'::class => function () {

      return \wp_get_theme( \get_template() );
    },
    '\\WP_Scripts'::class => function () {

      return \wp_scripts();
    },
    '\\WP_Styles'::class => function () {

      return \wp_styles();
    },
    '\\WpTheme\\Scaffold\\Core\\Contracts\\StorageInterface'::class => '\\WpTheme\\Scaffold\\Core\\Resources\\Storage'::class,
    '\\WpTheme\\Scaffold\\Core\\Contracts\\AssetInterface'::class => '\\WpTheme\\Scaffold\\Core\\Resources\\Asset'::class
  ],
  /**
   * Theme Option config
   */
  'option.theme.name'       => 'theme_option',
  'option.theme.capability' => 'edit_themes',
  /**
   * Theme Global Styles
   */
  'theme.styles' => [
    /**
     * Theme Breakpoints
     */
    'media.sm' => '414px',
    'media.md' => '768px',
    'media.lg' => '992px',
    'media.xl' => '1200px',
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
    'font.anchor'    => '12px',
    'font.paragraph' => '16px',
    'font.h6'        => '20px',
    'font.h5'        => '24px',
    'font.h4'        => '28px',
    'font.h3'        => '32px',
    'font.h2'        => '36px',
    'font.h1'        => '40px'
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
    'px-or-rem-unit'            => true
  ]
];