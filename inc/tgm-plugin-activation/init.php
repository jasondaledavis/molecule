<?php
include_once ( 'class-tgm-plugin-activation.php' );
function molecule_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => 'Content Aware Sidebars',
            'slug'      => 'content-aware-sidebars',
        ),

        array(
            'name'      => 'WP-PageNavi',
            'slug'      => 'wp-pagenavi',
        ),

        array(
            'name'      => 'SVG Support',
            'slug'      => 'svg-support',
        ),

        array(
            'name'      => 'Duplicate Post',
            'slug'      => 'duplicate-post',
        ),

        array(
            'name'      => 'Easy Google Fonts',
            'slug'      => 'easy-google-fonts',
        ),

    );

    tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'molecule_register_required_plugins' );