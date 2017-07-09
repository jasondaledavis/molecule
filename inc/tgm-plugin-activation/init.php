<?php
include_once ( 'class-tgm-plugin-activation.php' );
function molecule_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => __('WP-PageNavi', 'molecule' ),
            'slug'      => 'wp-pagenavi',
        ),

        array(
            'name'      => __('Easy Google Fonts', 'molecule' ),
            'slug'      => 'easy-google-fonts',
        ),

        array(
            'name'      => __('SVG Support', 'molecule' ),
            'slug'      => 'svg-support',
        ),

    );

    tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'molecule_register_required_plugins' );