<?php

include ( 'class-tgm-plugin-activation.php' );

if ( class_exists( 'WooCommerce' ) ) {

    function woo_register_required_plugins() {

        $wooplugins = array(
          
            array(
                'name'      => 'WooSidebars',
                'slug'      => 'woosidebars',
            ),

        );

    tgmpa( $wooplugins );

    }

} //end woo if

add_action( 'tgmpa_register', 'woo_register_required_plugins' );

function capstone_register_required_plugins() {

    $plugins = array(

        array(
            'name'      => 'Multiple Post Thumbnails',
            'slug'      => 'multiple-post-thumbnails',
            'required'           => false,
            'force_activation'      => true,
        ),

        array(
            'name'      => 'WP-PageNavi',
            'slug'      => 'wp-pagenavi',
        ),

        array(
            'name'      => 'SVG Support',
            'slug'      => 'svg-support',
            'force_activation'      => true,
        ),

        array(
            'name'      => 'Responsive Slider by MotoPress',
            'slug'      => 'motopress-slider-lite',
        ),

        array(
            'name'      => 'Page Builder by SiteOrigin',
            'slug'      => 'siteorigin-panels',
        ),

        array(
            'name'      => 'SiteOrigin CSS',
            'slug'      => 'so-css',
        ),

        array(
            'name'      => 'SiteOrigin Widgets Bundle',
            'slug'      => 'so-widgets-bundle',
        ),

        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
        ),

        array(
            'name'      => 'Contact Form 7 Honeypot',
            'slug'      => 'contact-form-7-honeypot',
        ),

    );

    tgmpa( $plugins );

}

add_action( 'tgmpa_register', 'capstone_register_required_plugins' );