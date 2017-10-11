<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Woody
 * @since Woody 1.0
 */
?>


		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'woody' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'woody' ); ?></p>
			<?php //get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'woody' ); ?></p>
			<?php //get_search_form(); ?>

		<?php endif; ?>

		<form class="searchbar" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">


							<div class="c6">
								
								<input id="prependedInput" type="text" value="" name="s" id="s"  size="100%" placeholder="<?php echo __( 'Enter your search term to try again...', 'woody' ); ?>"/> 

							</div><!-- end .c6 -->

						

						<div class="c6">

							<?php wp_dropdown_categories( 'show_option_all=All Categories' ); ?> 

							<p style="text-align: center;margin-top: 40px;"><input type="submit" id="searchsubmit" value="SEARCH IN CATEGORIES" class="button" />  <i class="fa fa-long-arrow-right"></i></p>

						</div><!-- end .c6 -->

					</form>
