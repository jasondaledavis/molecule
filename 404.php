<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 2.4.3
 */

get_header(); ?>

        <div class="grid wfull">

            <div class="row">

                <div class="c6">

                    <h1 class="entry-title"><?php _e( 'Uh Oh!!', 'molecule' ); ?></h1>

                    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'molecule' ); ?></p>

                    <?php get_search_form(); ?>

                </div><!-- end .c6 -->

                <div class="c6">

                    <div class="reply homepage-btn"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Go to the homepage', 'molecule' ); ?></a>
                    </div>

                </div><!-- end .c6 -->
               
            </div><!-- end .row -->

        </div><!-- end .grid -->

<?php get_footer(); ?>