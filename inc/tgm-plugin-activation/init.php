<?php
include_once ( 'class-tgm-plugin-activation.php' );
function woody_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => __('WP-PageNavi', 'woody' ),
            'slug'      => 'wp-pagenavi',
        ),

        array(
            'name'      => __('Easy Google Fonts', 'woody' ),
            'slug'      => 'easy-google-fonts',
        ),

        array(
            'name'      => __('SVG Support', 'woody' ),
            'slug'      => 'svg-support',
        ),

    );

    tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'woody_register_required_plugins' );