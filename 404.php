<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */

get_header(); ?>

        <div class="grid">

            <div class="row">

                <div class="c12">

                    <h1 class="entry-title"><?php _e( 'Uh Oh!!', 'molecule' ); ?></h1>

                    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'molecule' ); ?></p>

                    <?php get_search_form(); ?>


                    <p><a class="read-more" href="<?php echo home_url(); ?>"><?php _e( 'Go to the homepage', 'molecule' ); ?></a></p>

                </div>
               
            </div>

        </div><!-- end .grid -->

<?php get_footer(); ?>