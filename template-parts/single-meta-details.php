<?php
/**
 * The template part for displaying Post meta details in header
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>
<div class="meta-details">

	<?php molecule_entry_meta(); ?>
	
	<a href="https://www.facebook.com/sharer/sharer.php?t=<?php the_title(); ?>&amp;u=<?php the_permalink(); ?>" onclick="window.open(this.href,this.target,'width=600,height=400,resizeable,scrollbars');return" target="_blank" ><i class="fa fa-facebook-official"></i></a>
	<a href="https://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php echo the_permalink(); ?>" onclick="window.open(this.href,this.target,'width=600,height=400,resizeable,scrollbars');return" target="_blank" ><i class="fa fa-twitter-square"></i></a>
	<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" id="google-plus" onclick="window.open(this.href,this.target,'width=500,height=400,resizeable,scrollbars');return" target="_blank" ><i class="fa fa-google-plus-square"></i></a></p>

</div><!-- end .meta-details -->