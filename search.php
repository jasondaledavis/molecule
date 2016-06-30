<?php
/**
 * The template for displaying search results pages.
 *
 * @package molecule
 */
get_header( 'inner' ); ?>

        <div class="grid">
            
            <div class="row">
                
                <div class="c12">
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						
					<article <?php post_class( 'post-excerpt' ); ?>>
						
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'news-large' ); ?>
						</a>
				
						<h1 class="page-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						
						<?php the_excerpt(); ?>

						<p><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read Article', 'molecule' ); ?></a></p>
											
					</article><!-- end .post-excerpt -->
						
				<?php endwhile; endif; ?>
				
				<?php if ( !have_posts() ) : ?>

				    <h3><em><?php _e( 'Sorry, but no results were found for: ', 'molecule' ); ?><?php the_search_query(); ?></em></h3>

				    <p><em><?php _e( 'Please try the search again. Enter your search term, then select a categoty to run your search.', 'molecule' ); ?></em></p>

					<form class="searchbar" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">

						<div class="input-prepend">

							<div class="c6">
								
								<input id="prependedInput" type="text" value="" name="s" id="s"  size="100%" placeholder="<?php echo __( 'Enter your search term to try again...', 'molecule' ); ?>"/> 

							</div><!-- end .c6 -->

						</div><!-- end .input-prepend -->

						<div class="c6">

							<?php wp_dropdown_categories( 'show_option_all=All Categories' ); ?> 

							<p style="text-align: center;margin-top: 40px;"><input type="submit" id="searchsubmit" value="SEARCH IN CATEGORIES" class="button" />  <i class="fa fa-long-arrow-right"></i></p>

						</div><!-- end .c6 -->

					</form>
			
				<?php endif; ?>
				
				<?php if( function_exists( 'wp_pagenavi' ) ) { ?>
				<?php wp_pagenavi(); ?>   
				<?php } else { ?>      
				  <div class="post-navigation"><p><?php posts_nav_link( '&#8734;','&laquo;&laquo; Previous Posts','Older Posts &raquo;&raquo;' ); ?></p></div>
				<?php } ?>
                
                </div><!-- end .c12 -->
            
            </div><!-- end .row -->

        </div><!-- end .grid -->
			
<?php get_footer(); ?>