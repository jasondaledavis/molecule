<?php if (is_front_page() ) { ?>
<?php
/**
* The main template file.
*
* @package molecule
*/
get_header(); ?>

<?php } else { ?>

<?php

get_header( 'inner' ); ?>

<?php } ?>

<?php if ( is_active_sidebar( 'sidebar-blog' )  ) : ?>

	<div class="grid">

		<div class="row">

			<div class="c9">

				<div class="post-index">

					<?php $counter = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); 

					if(++$counter % 2 == 0) {

					if( class_exists ( 'Advads_Ad' ) ) { 

					echo 
					'<div class="hs-ad">
					<div class="grid">
					<div class="row">
					<div class="c9">';

					the_ad_placement('manual'); 

					echo '</div>
					</div>
					</div>
					</div>'; }

					} ?>

					<article <?php post_class( 'post-excerpt' ); ?>>

						<div class="date-stamp">
							<div class="month updated"><?php the_time( 'M' ); ?></div>
							<div class="date-border"></div>
							<div class="day updated"><?php the_time( 'd' ); ?></div>
						</div>

						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<div class="meta-details">

							<p><?php _e( '<i class="fa fa-clock-o"></i> Posted on', 'molecule' ); ?> <span class="post-date updated"><?php the_time( 'F jS Y' ); ?></span> / <?php _e( '<i class="fa fa-folder-open-o"></i> in', 'molecule' ); ?> <span><?php the_category( ' & ' ); ?></span> / <?php _e( '<i class="fa fa-comment-o"></i> with', 'molecule' ); ?> <span> <a href="<?php the_permalink(); ?>#comments"><?php $commentscount = get_comments_number(); echo $commentscount; ?> <?php _e( 'Comments', 'molecule' ); ?></a></span></p>

						</div><!-- end .meta-details -->

						<div class="post-thumbnail">

							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'news-large' ); ?></a>

						</div><!-- end .post-thumbnail -->

						<?php the_excerpt(); ?>

						<div class="btn">

							<a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read Article', 'molecule' ); ?></a>

						</div>

					</article><!-- end .post-excerpt -->

				<?php endwhile; endif; ?>

				<?php if( function_exists( 'wp_pagenavi' ) ) { ?>
				<?php wp_pagenavi(); ?>   
				<?php } else { ?>      
				<?php posts_nav_link( '&#8734;','&laquo;&laquo; Previous Posts','Older Posts &raquo;&raquo;' ); ?>
				<?php } ?>

				</div><!-- end .post-index -->

			</div><!-- end .c9 -->

		<?php get_sidebar(); ?>

		</div><!-- end .row -->

	</div><!-- end .grid -->

<?php elseif ( !is_active_sidebar( 'sidebar-blog' )  ) : ?>

	<div class="grid wfull">

		<div class="row">

			<div class="c12">

				<?php $counter = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); 

				if(++$counter % 2 == 0) {

				if( class_exists ( 'Advads_Ad' ) ) { 

				echo 
				'<div class="hs-ad">
				<div class="grid">
				<div class="row">
				<div class="c12">';

				the_ad_placement('manual'); 

				echo '</div>
				</div>
				</div>
				</div>'; }

				} ?>

				<article <?php post_class( 'post-excerpt' ); ?>>

					<div class="date-stamp">
						<div class="month updated"><?php the_time( 'M' ); ?></div>
						<div class="date-border"></div>
						<div class="day updated"><?php the_time( 'd' ); ?></div>
					</div>

				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="meta-details">

						<p><?php _e( '<i class="fa fa-clock-o"></i> Posted on', 'molecule' ); ?> <span class="post-date updated"><?php the_time( 'F jS Y' ); ?></span> / <?php _e( '<i class="fa fa-folder-open-o"></i> in', 'molecule' ); ?> <span><?php the_category( ' & ' ); ?></span> / <?php _e( '<i class="fa fa-comment-o"></i> with', 'molecule' ); ?> <span> <a href="<?php the_permalink(); ?>#comments"><?php $commentscount = get_comments_number(); echo $commentscount; ?> <?php _e( 'Comments', 'molecule' ); ?></a></span></p>

					</div><!-- end .meta-details -->

					<div class="post-thumbnail">

						<a href="<?php the_permalink(); ?>">
						<?php
						if ( has_post_thumbnail($post->ID) ){   
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'news-large');
						$image = $image[0];
						$alt = get_bloginfo( 'description' );
						echo '<img src="'.$image.'" alt="'.$alt.'" />';
						} else {  
						$image = get_template_directory_uri() .'/assets/img/placeholders/landscape_placeholder.jpg'; 
						$alt = get_bloginfo( 'description' );
						echo '<img src="'.$image.'" alt="'.$alt.'" />';
						}
						?>
						</a>

					</div><!-- end .post-thumbnail -->

				<?php the_excerpt(); ?>

					<div class="btn">

						<a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read Article', 'molecule' ); ?></a>

					</div>

				</article><!-- end .post-excerpt -->

				<?php endwhile; endif; ?>

				<?php if( function_exists( 'wp_pagenavi' ) ) { ?>
				<?php wp_pagenavi(); ?>   
				<?php } else { ?>      
				<?php posts_nav_link( '&#8734;','&laquo;&laquo; Previous Posts','Older Posts &raquo;&raquo;' ); ?>
				<?php } ?>

			</div><!-- end .c12 -->

		</div><!-- end .row -->

	</div><!-- end .grid -->

<?php endif; ?>

<?php get_footer(); ?>