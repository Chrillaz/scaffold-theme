<?php

namespace Scaffold\Theme;

use \Scaffold\Essentials\Utilities as Util;

require __DIR__ . '/../vendor/autoload.php';

$app = \Scaffold\Essentials\Essentials::create([
  'basepath'   => \get_template_directory(),
  'publicpath' => \get_template_directory_uri(),
  'publicdir'  => '/public'
]);

$app->singleton( \Scaffold\Theme\Theme::class );

$hookloader = $app->make( \Scaffold\Essentials\Services\HookLoader::class );

/**
 * Theme Options
 */
Util::directoryIterator( 
    $app->getBasepath( '/src/Options' ), 
    function ( $option ) use ( $app ) {

        $app->singleton( $option->qualifiedname, function ( $container ) use ( $option ) {
            
            return $option->qualifiedname::register( $container );
        });
    }
);

/**
 * Run Core, App Hooks and Integrations
 */
array_map( 
    function ( $directory ) use ( $app, $hookloader ) {

        Util::directoryIterator( 
            $directory, 
            function ( $hook ) use ( $app, $hookloader ) {

                $hook = $app->makeWith( $hook->qualifiedname, [
                    'theme' => $app->make( \Scaffold\Theme\Theme::class )
                ]);
    
                $hook->register( $hookloader );
            }
        );
    }, 
    [
        // $app->getBasepath( '/src/Integrations' ),
        $app->getBasepath( '/src/Hooks' )
    ]
);
