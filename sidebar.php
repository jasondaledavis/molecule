<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>

<!-- Page sidebar only for pages -->
<?php if ( is_page() ): ?>

    <?php if ( is_active_sidebar( 'sidebar-page' )  ) : ?>
       
        <aside class="sidebar c3">

            <?php dynamic_sidebar( 'sidebar-page' ); ?>

        </aside><!-- end .sidebar -->

    <?php endif; ?> 

<?php endif; ?>

<!-- If is blog, search or single.php -->
<?php if ( is_home() || is_single() || is_archive() || is_search() ): ?>

    <?php if ( is_active_sidebar( 'sidebar-blog' )  ) : ?>

        <aside class="sidebar c3">

            <?php dynamic_sidebar( 'sidebar-blog' ); ?>

        </aside><!-- end .sidebar -->

    <?php endif; ?> 

<?php endif; ?>