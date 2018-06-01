<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<?php do_action( 'woocommerce_before_main_content' ); ?>

    <div class="grid wfull">

        <div class="row">

            <?php if ( is_active_sidebar( 'sidebar-shop' )  ) {

            echo '<div class="c9">';

            } else {  

            echo '<div class="c12">';
            
            } ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

				

			</div><!-- end .c9 or .c12 -->

				<?php
					/**
					 * woocommerce_sidebar hook.
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				?>

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php do_action( 'woocommerce_after_main_content' ); ?>

<?php get_footer(); ?>