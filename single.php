<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 2.4.4
 */

get_header(); ?>

    <div class="grid wfull">

        <div class="row">

                <?php if ( is_active_sidebar( 'sidebar-blog' )  ) {

                    echo '<div class="c9">';

                    } else {  

                    echo '<div class="c12">';
                
                } ?>

                <?php if ( function_exists('yoast_breadcrumb') ) {

                    yoast_breadcrumb('<p id="breadcrumbs">','</p>');

                } ?>

                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                    // Include the single post content template.
                    get_template_part( 'template-parts/content', 'single' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }

                    if ( is_singular( 'attachment' ) ) {
                        // Parent post navigation.
                        the_post_navigation( array(
                            'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'molecule' ),
                        ) );
                    } elseif ( is_singular( 'post' ) ) {
                        // Previous/next post navigation.
                        the_post_navigation( array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'molecule' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Previous post:', 'molecule' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'molecule' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Next post:', 'molecule' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                        ) );
                    }

                    // End of the loop.
                endwhile;
                ?>  

            </div><!-- end .c9 or .c12 -->

            <?php get_sidebar(); ?>

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php get_footer(); ?>