<?php
/**
 * The template for displaying search results pages
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


					<?php if ( have_posts() ) : 
					
					// Start the loop. 
					while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

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
						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
                
                </div><!-- end .c12 -->
            
            	<?php get_sidebar(); ?>
            
            </div><!-- end .row -->

        </div><!-- end .grid -->
			
<?php get_footer(); ?>