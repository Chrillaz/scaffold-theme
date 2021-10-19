<?php

namespace Scaffold\Theme;

return [
    /**
     * Theme namespace
     */
    'namespace' => '\\Scaffold\\Theme',
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
    'option.theme.default'     => [
        'block-styles'      => true,
        'editor-styles'     => true,
        'align-wide'        => true,
        'responsive-embeds' => true,
        'block-templates'   => false,
        'update-access'     => ''
    ],

    'option.cookie.name'       => 'scaffold_cookie',
    'option.cookie.capability' => 'edit_posts',
    'option.cookie.default'    => [
        'activate'       => true,
        'timeout'        => 5000,
        'accept_content' => 'OK',
        'content'        => '...Example text',
    ]
];