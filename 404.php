<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Woody
 * @since Woody 1.0
 */

get_header(); ?>

        <div class="grid">

            <div class="row">

                <div class="c6">

                    <h1 class="entry-title"><?php _e( 'Uh Oh!!', 'woody' ); ?></h1>

                    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'woody' ); ?></p>

                    <?php get_search_form(); ?>


                    <div class="reply homepage-btn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Go to the homepage', 'woody' ); ?></a>
                    </div>

                </div>

                <div class="c6">

                </div>
               
            </div>

        </div><!-- end .grid -->

<?php get_footer(); ?>