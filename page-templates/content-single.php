<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">

			<?php
				
				the_content();

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'molecule' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'molecule' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

				if ( '' !== get_the_author_meta( 'description' ) ) {
					get_template_part( 'page-templates/biography' );
				}
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<div class="post-tags">
                
                <p class="tag-title">tags:</p><?php the_tags( ' ',' ' ); ?>
            
            </div>

            <?php //get_template_part( 'partials/social', 'share' ); ?>

			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'molecule' ),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>

		</footer><!-- .entry-footer -->

	</article><!-- #post-## -->