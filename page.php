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

<?php if ( is_active_sidebar( 'sidebar-page' )  ) : ?>

    <div class="grid">

        <div class="row">

            <div class="c9">

				<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'page-templates/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

						// End of the loop.
					endwhile;
				?>

			</div><!-- end .c9 -->

            <?php get_sidebar(); ?>

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php elseif ( !is_active_sidebar( 'sidebar-page' )  ) : ?>

    <div class="grid wfull">

        <div class="row">

            <div class="c12">

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'page-templates/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}

					// End of the loop.
				endwhile;
				?>

			</div><!-- end .c12 -->

        </div><!-- end .row -->

    </div><!-- end .grid .wfull-->

   <?php endif; ?>

<?php get_footer(); ?>
