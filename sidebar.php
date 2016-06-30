<?php global $capstone_molecule; ?>
<?php
/**
 * The sidebar containing the main widget areas.
 * Only used on Visual Composer Pages and using the "widgetized sidebar" shortcode. 
 * See https://wpbakery.atlassian.net/wiki/display/VC/Content+Elements#ContentElements-WitgetisedSidebar 
 * for instruction.
 * 
 * @package Molecule
 */
?>

    <?php if ( is_home() || is_single() || is_archive() || is_search() ): ?>

       
            <aside class="sidebar c3">

                <?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'Blog Sidebar' ) ) : else : ?>
                <?php endif; ?>

            </aside><!-- end .sidebar -->

    <?php endif; ?>

    <?php if ( class_exists( 'WooCommerce' ) ) { ?>

    <?php if ( is_shop() || is_product() || is_cart() || is_checkout() || is_account_page() ): ?>

       
            <aside class="sidebar c3">

                <?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'Shop Sidebar' ) ) : else : ?>
                <?php endif; ?>

            </aside><!-- end .sidebar -->

    <?php endif; ?>

    <?php }?>