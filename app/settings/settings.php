<?php

/**
 * Theme settings and global
 */

use Theme\includes\Config;

$theme_info = wp_get_theme();

Config::define( 'THEME_TEMPLATE_DIR', '/views' );

Config::define( 'THEME_NAME', $theme_info['Name'] );

Config::define( 'THEME_VERSION', $theme_info['Version'] );

Config::define( 'THEME_AUTHOR_URL', $theme_info['AuthorURL'] );

Config::define( 'THEME_AUTHOR', $theme_info['Author'] );

Config::define( 'THEME_FONT_MAP', [
  '<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="preconnect">',
  '<link href="https://fonts.googleapis.com/css2?family=KoHo:wght@400;700&display=swap" rel="preconnect">',
  '<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600&display=swap" rel="preconnect">',
  '<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="preconnect">'
]);

Config::apply();