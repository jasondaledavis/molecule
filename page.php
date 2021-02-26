<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */

get_header(); ?>

    <div class="grid wfull">

        <div class="row">

            <?php if ( !is_front_page() && is_active_sidebar( 'sidebar-page' ) ) {

            echo '<div class="c9">';

            } else {  

            echo '<div class="c12">';
            
            } ?> 

            	<?php
					if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
					yoast_breadcrumb('
					<p id="breadcrumbs">','</p>
					');
					}
				?>

				<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'template-parts/content', 'page' );
						
						// End of the loop.
					endwhile;
				?>

			</div><!-- end .c9 or .c12 -->

			<?php if ( !is_front_page() ) : ?>

			    <?php get_sidebar(); ?>

			<?php endif; ?>

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php get_footer(); ?>
