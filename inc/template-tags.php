<?php
/**
 * Custom Molecule template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Molecule 1.0
 */

if ( ! function_exists( 'molecule_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own molecule_entry_meta() function to override in a child theme.
 *
 * @since Molecule 1.0
 */
function molecule_entry_meta() {

	// if ( 'post' === get_post_type() ) {
	// 	$author_avatar_size = apply_filters( 'molecule_author_avatar_size', 80 );
	// 	printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
	// 		get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
	// 		printf( '<span class="author-title">Author</span> ', 'Used before post author name.', 'molecule' ),
	// 		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
	// 		get_the_author()
	// 	);
	// }
	
	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		molecule_entry_date();
	}

	if ( 'post' === get_post_type() ) {
		molecule_entry_taxonomies();
	}

	if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo ' <span class="comments-link">';
		comments_popup_link( sprintf( __( 'Recent Comments <span class="screen-reader-text entry-title"> on %s </span>', 'molecule' ), get_the_title() ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'molecule_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own molecule_entry_date() function to override in a child theme.
 *
 * @since Molecule 1.0
 */
function molecule_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on updated"><span class="screen-reader-text updated">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'molecule' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'molecule_entry_taxonomies' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own molecule_entry_taxonomies() function to override in a child theme.
 *
 * @since Molecule 1.0
 */
function molecule_entry_taxonomies() {
	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'molecule' ) );
	if ( $categories_list && molecule_categorized_blog() ) {
		printf( '<span class="cat-links"><span class="screen-reader-text"> %1$s </span> %2$s </span>',
			printf( '<span class="cat-title">Categories:</span> ', 'Used before category names.', 'molecule' ),
			$categories_list
		);
	}

	$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'molecule' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span class="screen-reader-text"> %1$s </span> %2$s </span>',
			printf( '<span class="tag-title">Tags:</span> ', 'Used before tag names.', 'molecule' ),
			$tags_list
		);
	}
}
endif;


if ( ! function_exists( 'molecule_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function molecule_posted_on() {
	// Get the author name; wrap it in a link.
	$byline = sprintf(
		_x( 'by %s', 'post author', 'molecule' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);
	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">Posted on: ' . molecule_time_link() . '</span> <span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;



if ( ! function_exists( 'molecule_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function molecule_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'molecule' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;

if ( ! function_exists( 'molecule_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own molecule_post_thumbnail() function to override in a child theme.
 *
 * @since Molecule 1.0
 */
function molecule_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'molecule_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own molecule_excerpt() function to override in a child theme.
	 *
	 * @since Molecule 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function molecule_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php //echo $class; ?> -->
		<?php endif;
	}
endif;

if ( ! function_exists( 'molecule_categorized_blog' ) ) :
/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own molecule_categorized_blog() function to override in a child theme.
 *
 * @since Molecule 1.0
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function molecule_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'molecule_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'molecule_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so molecule_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so molecule_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in molecule_categorized_blog().
 *
 * @since Molecule 1.0
 */
function molecule_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'molecule_categories' );
}
add_action( 'edit_category', 'molecule_category_transient_flusher' );
add_action( 'save_post',     'molecule_category_transient_flusher' );

if ( ! function_exists( 'molecule_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Molecule 1.2
 */
function molecule_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;
