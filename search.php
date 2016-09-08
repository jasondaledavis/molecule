<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */

get_header(); ?>

        <div class="grid">
            
            <div class="row">
                
                <div class="c12">

					<?php if ( have_posts() ) : 
			// Start the loop. 
					while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'page-templates/content', 'search' );

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
                
                </div><!-- end .c12 -->
            
            </div><!-- end .row -->

        </div><!-- end .grid -->
			
<?php get_footer(); ?>