<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */

get_header(); ?>

<?php if ( is_active_sidebar( 'sidebar-blog' )  ) : ?>

    <div class="grid">

        <div class="row">

            <div class="c9">
            
                <div class="post-index">

                <?php if ( have_posts() ) : ?>

        		<?php if ( is_home() && ! is_front_page() ) : ?>
        			<header>
        				<h1 class="page-title screen-reader-text"><span class="entry-title"><?php single_post_title(); ?></span></h1>
        			</header>
        		<?php endif; ?>

        		<?php
                    // Start the loop.
                    while ( have_posts() ) : the_post();

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'page-templates/content', get_post_format() );

                    // End the loop.
                    endwhile;

                    // Previous/next page navigation.
                    the_posts_pagination( array(
                        'prev_text'          => __( '', 'molecule' ),
                        'next_text'          => __( '', 'molecule' ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'molecule' ) . ' </span>',
                    ) );

                // If no content, include the "No posts found" template.
                else :
                    get_template_part( 'page-templates/content', 'none' );

                endif;
                ?>
               
                </div><!-- end .post-index -->

            </div><!-- end .c9 -->

            <?php get_sidebar(); ?>

        </div><!-- end .row -->

    </div><!-- end .grid -->

<?php elseif ( !is_active_sidebar( 'sidebar-blog' )  ) : ?>

    <div class="grid wfull">

        <div class="row">

            <div class="c12">

                <div class="post-index">

                    <?php if ( have_posts() ) : ?>

                    <?php if ( is_home() && ! is_front_page() ) : ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><span class="entry-title"><?php single_post_title(); ?></span></h1>
                        </header>
                    <?php endif; ?>

                    <?php
                        // Start the loop.
                        while ( have_posts() ) : the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'page-templates/content', get_post_format() );

                        // End the loop.
                        endwhile;

                        // Previous/next page navigation.
                        the_posts_pagination( array(
                            'prev_text'          => __( '', 'molecule' ),
                            'next_text'          => __( '', 'molecule' ),
                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'molecule' ) . ' </span>',
                        ) );

                    // If no content, include the "No posts found" template.
                    else :
                        get_template_part( 'page-templates/content', 'none' );

                    endif;
                    ?>

                </div><!-- end .post-index -->

            </div><!-- end .c12 -->

        </div><!-- end .row -->

    </div><!-- end .grid .wfull -->

    
<?php endif; ?>

<?php get_footer(); ?>