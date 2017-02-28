<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'molecule' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2><span class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span></h2>' ); ?>
	</header><!-- .entry-header -->

<?php molecule_entry_meta(); ?>

<?php molecule_post_thumbnail(); ?>

<h4 class="blog-author-title">Article written by: <span class="vcard author post-author"><span class="fn"><?php the_author(); ?></span></span> <span class="post_date date updated"><?php the_time('j F,Y'); ?></span></h4>

	<div class="entry-content">

	<?php the_excerpt ( sprintf(
				/* translators: %s: Name of current post */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'molecule' ),
				get_the_title()
			) ); ?>

						<div class="btn">

							<a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read Article', 'molecule' ); ?></a>

						</div>

		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'molecule' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'molecule' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		
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