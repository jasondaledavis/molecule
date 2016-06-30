<?php

include_once ( 'class-tgm-plugin-activation.php' );

function capstone_register_required_plugins() {

    $plugins = array(
        array(
            'name'                  => 'Visual Composer',
            'version'               => '4.11',
            'slug'                  => 'js_composer',
            'source'                => CAPSTONE_THEME_DIR . 'capstone/tgm-plugin-activation/plugins/js_composer.zip',
            'external_url'          => '',
        ),

        array(
           'name'                => 'Gravity Forms',
           'slug'                => 'gravityforms', 
           'source'              => CAPSTONE_THEME_DIR . 'capstone/tgm-plugin-activation/plugins/gravityforms.zip', 
           'version'             => '1.9',
           'external_url'        => '',
        ),

        array(
           'name'                => 'WP Inbound',
           'slug'                => 'wp-inbound', 
           'source'              => CAPSTONE_THEME_DIR . 'capstone/tgm-plugin-activation/plugins/wp-inbound.zip', 
           'version'             => '1.0',
        ),

        array(
            'name'      => 'Master Slider - Responsive Touch Slider',
            'slug'      => 'masterslider',
            'source'              => CAPSTONE_THEME_DIR . 'capstone/tgm-plugin-activation/plugins/masterslider.zip',
        ),

        array(
            'name'      => 'Responsive Menu',
            'slug'      => 'responsive-menu',
        ),

        array(
            'name'      => 'Jetpack',
            'slug'      => 'jetpack',
        ),

        array(
            'name'      => 'Multiple Post Thumbnails',
            'slug'      => 'multiple-post-thumbnails',
            'required'  => true,
            'is_automatic'          => true,
        ),

        array(
            'name'      => 'Yoast SEO',
            'slug'      => 'wordpress-seo',
        ),

        array(
            'name'      => 'Duplicate Post',
            'slug'      => 'duplicate-post',
        ),

        array(
            'name'      => 'Post Type Converter',
            'slug'      => 'post-type-converter',
        ),

        array(
            'name'      => 'AMP',
            'slug'      => 'amp',
        ),

    );

    tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'capstone_register_required_plugins' );