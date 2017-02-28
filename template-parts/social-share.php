<?php
/**
 * The template part for displaying an Social Share in posts footer
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>
<div class="social-share">

<h4>Spread the <span class="genericon genericon-heart"></span> with a click below:</h4>

<ul>
    <li><a href="https://facebook.com/sharer/sharer.php?t=<?php the_title(); ?>&amp;u=<?php the_permalink(); ?>" onclick="window.open(this.href,this.target,'width=600,height=400,resizeable,scrollbars');return" target="_blank" ><span class="genericon genericon-facebook"></span></a></li>
    <li><a href="https://twitter.com/share?text=<?php the_title(); ?> via @weareelement502&amp;url=<?php echo the_permalink(); ?>" onclick="window.open(this.href,this.target,'width=600,height=400,resizeable,scrollbars');return" target="_blank" ><span class="genericon genericon-twitter"></span></a></li>
    <li><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" id="google-plus" onclick="window.open(this.href,this.target,'width=500,height=400,resizeable,scrollbars');return" target="_blank" ><span class="genericon genericon-googleplus"></span></a></li>
    <li><a href="https://www.linkedin.com/shareArticle?url=<?php echo get_permalink(); ?>" id="linkedin" onclick="window.open(this.href,this.target,'width=500,height=400,resizeable,scrollbars');return" target="_blank" ><span class="genericon genericon-linkedin-alt"></span></a></li>
</ul>

</div>