<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Woody
 * @since Woody 1.0
 */

get_header(); ?>

<?php if ( is_active_sidebar( 'sidebar-blog' )  ) : ?>

    <div class="grid">

        <div class="row">

            <div class="c9">

                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('
                    <p id="breadcrumbs">','</p>
                    ');
                    }
                ?>

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
                            'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'woody' ),
                        ) );
                    } elseif ( is_singular( 'post' ) ) {
                        // Previous/next post navigation.
                        the_post_navigation( array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'woody' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Previous post:', 'woody' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'woody' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Next post:', 'woody' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                        ) );
                    }

                    // End of the loop.
                endwhile;
                ?>  

            </div><!-- end .c9 -->

            <?php get_sidebar(); ?>

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php elseif ( !is_active_sidebar( 'sidebar-blog' )  ) : ?>

    <div class="grid wfull">

        <div class="row">

            <div class="c12">

                <?php
                    if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('
                    <p id="breadcrumbs">','</p>
                    ');
                    }
                ?>

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
                            'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'woody' ),
                        ) );
                    } elseif ( is_singular( 'post' ) ) {
                        // Previous/next post navigation.
                        the_post_navigation( array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'woody' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Previous post:', 'woody' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'woody' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Next post:', 'woody' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                        ) );
                    }

                    // End of the loop.
                endwhile;
                ?>

            </div><!-- end .c12 -->

        </div><!-- end .row -->

    </div><!-- end .grid .wfull -->

<?php endif; ?>

<?php get_footer(); ?>