<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

                <?php if ( have_posts() ) : 
                    // Start the Loop.
                    while ( have_posts() ) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content' );

                    // End the loop.
                    endwhile;

                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( '', 'woody' ),
                        'next_text'          => __( '', 'woody' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'woody' ) . ' </span>',
                    ) );

                // If no content, include the "No posts found" template.
                else :
                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>

            </div><!-- end .c9 -->

            <?php get_sidebar(); ?>

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php elseif ( !is_active_sidebar( 'sidebar-blog' )  ) : ?>

<div class="grid wfull">

        <div class="row">

            <div class="c12">

                <?php if ( have_posts() ) : 
                    // Start the Loop.
                    while ( have_posts() ) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content' );

                    // End the loop.
                    endwhile;

                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( 'Previous page', 'woody' ),
                        'next_text'          => __( 'Next page', 'woody' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'woody' ) . ' </span>',
                    ) );

                // If no content, include the "No posts found" template.
                else :
                    get_template_part( 'template-parts/content', 'none' );

                endif;
                ?>

            </div><!-- end .c12 -->

        </div><!-- end .row -->

    </div><!-- end .grid .wfull-->

<?php endif; ?>

<?php get_footer(); ?>