<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Woody
 * @since Woody 1.0
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


<?php if ( class_exists( 'WooCommerce' ) ) { 
// Checks for WooCommerceplugin
  $bIsWoo=is_woocommerce();

} else {

  $bIsWoo=false; 

} ?> 

<?php if ( ( is_active_sidebar( 'sidebar-blog' ) || is_single() || is_archive() || is_search() ) && !$bIsWoo ) : // If is blog, search or single.php ?>

    <aside class="sidebar c3">

        <?php dynamic_sidebar( 'sidebar-blog' ); ?>

    </aside><!-- end .sidebar -->

<?php endif; ?> 

<?php if ( class_exists( 'WooCommerce' ) ) { ?>
 
    <?php if ( is_active_sidebar( 'sidebar-shop' ) && is_woocommerce() ): ?>
 
            <aside class="sidebar c3">
 
                <?php dynamic_sidebar( 'sidebar-shop' ); ?>
 
            </aside><!-- end .sidebar -->
 
    <?php endif; ?>
 
<?php }?>