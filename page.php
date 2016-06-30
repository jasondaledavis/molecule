<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template possibly.
 *
 * @package molecule
 */
get_header( 'inner' ); ?>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; endif; ?>

<?php get_footer(); ?>