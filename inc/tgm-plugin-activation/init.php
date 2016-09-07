<?php
function capstone_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => 'WP-PageNavi',
            'slug'      => 'wp-pagenavi',
        ),

        array(
            'name'      => 'SVG Support',
            'slug'      => 'svg-support',
            'force_activation'      => true,
        ),

    );

    tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'capstone_register_required_plugins' );