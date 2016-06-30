<?php
/**
 * Template Name: Page (Non-Visual Composer)
 * Description: The template for displaying a standard page when Visual Composer is not in use.
 *
 * @package molecule
 */
get_header( 'inner' ); ?>

    <div class="grid">

        <div class="row">

            <div class="c12">

            	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            	<?php the_content(); ?>

            <?php endwhile; endif; ?>

            </div><!-- end .c12 -->

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php get_footer(); ?>