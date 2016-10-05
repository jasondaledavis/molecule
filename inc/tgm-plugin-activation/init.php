<?php
function molecule_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => 'WP-PageNavi',
            'slug'      => 'wp-pagenavi',
        ),

        array(
            'name'      => 'SVG Support',
            'slug'      => 'svg-support',
        ),

    );

    tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'molecule_register_required_plugins' );