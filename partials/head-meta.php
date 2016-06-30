<?php global $capstone_molecule; ?>
<!DOCTYPE html>
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="ie9"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
    <head>

        <!-- Meta
        ================================================== -->

        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php endif; ?>

        <!-- Favicons
        ================================================== -->

        <?php if ( isset( $capstone_molecule['general-custom-favicon']['url'] ) ) { ?>
            <link rel="icon" type="image/png" href="<?php echo $capstone_molecule['general-custom-favicon']['url']; ?>" />
        <?php } if ( isset( $capstone_molecule['general-apple-touch-icon-iphone']['url'] ) ) { ?>
            <link rel="apple-touch-icon" href="<?php echo $capstone_molecule['general-apple-touch-icon-iphone']['url']; ?>" />
        <?php } if ( isset( $capstone_molecule['general-apple-touch-icon-ipad']['url'] ) ) { ?>
            <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $capstone_molecule['general-apple-touch-icon-ipad']['url']; ?>" />
        <?php } if ( isset( $capstone_molecule['general-apple-touch-icon-iphone-retina']['url'] ) ) { ?>
            <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $capstone_molecule['general-apple-touch-icon-iphone-retina']['url']; ?>" />
        <?php } if ( isset( $capstone_molecule['general-apple-touch-icon-ipad-retina']['url'] ) ) { ?>
            <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $capstone_molecule['general-apple-touch-icon-ipad-retina']['url']; ?>" />
        <?php } ?>

        <?php wp_head(); ?>
        
    </head>