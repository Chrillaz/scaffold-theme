<?php

/**
 * Functions / Helpers
 */
function component ( $component, $args = [] ) {

    get_template_part( "templates/components/$component", 'component', $args );
}

/**
 * Site cred
 * Outputs cred and link to autor
 */
function siteCred () {

    echo sprintf( 'Hemsida utvecklad av <a href="%s">%s</a>', 
        Theme()->get( 'AuthorURI' ),
        Theme()->get( 'Author' )
    );
}