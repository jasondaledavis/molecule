<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>


<?php if ( is_page() ): ?>

<!-- Page sidebar only for pages -->
    <?php if ( is_active_sidebar( 'sidebar-page' )  ) : ?>
       
        <aside class="sidebar c3">

            <?php dynamic_sidebar( 'sidebar-page' ); ?>

        </aside><!-- end .sidebar -->

    <?php endif; ?> 

<?php endif; ?>

<?php if ( is_home() || is_single() || is_archive() || is_search() ): ?>

<!-- If is blog, search or single.php -->
    <?php if ( is_active_sidebar( 'sidebar-blog' )  ) : ?>

        <aside class="sidebar c3">

            <?php dynamic_sidebar( 'sidebar-blog' ); ?>

        </aside><!-- end .sidebar -->

    <?php endif; ?> 

<?php endif; ?>

<?php if ( class_exists( 'WooCommerce' ) ) { ?>
 
    <?php if ( is_shop() || is_product() || is_cart() || is_checkout() || is_account_page() ): ?>
 
        
            <aside class="sidebar c3">
 
                <?php if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'Shop Sidebar' ) ) : else : ?>
                <?php endif; ?>
 
            </aside><!-- end .sidebar -->
 
    <?php endif; ?>
 
    <?php }?>