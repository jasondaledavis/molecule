<?php
/**
 * The template for displaying all single posts.
 *
 * @package molecule
 */
get_header( 'inner' ); ?>

<div class="grid">

    <div class="row">
        
        <div class="c12">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <article <?php post_class( 'post-single' ); ?>>
                
                <div class="entry">
               
                <?php the_content(); ?>  

                        <?php get_template_part( 'partials/social', 'share' ); ?>

                    <div class="post-tags">
                        
                        <p class="tag-title">tags:</p><?php the_tags( ' ',' ' ); ?>
                    
                    </div>

                </div>

                <?php wp_link_pages(); ?>

            </article><!-- end .post-single -->

        <?php endwhile; endif; ?>

        <?php if ( is_singular(array('post')) ) { ?>

            <div class="author-bio">

                <?php echo get_avatar( get_the_author_meta( 'email' ), '200' ); ?>

                <div class="author-info">

                    <p class="about-author vcard author"><?php _e( 'about the author', 'molecule' ); ?>: <span class="fn author"><?php the_author_link(); ?></span></p>

                    <?php get_template_part( 'partials/author', 'icons' ); ?>

                    <p class="author-description author"><?php the_author_meta( 'description' ); ?></p>

                </div><!-- end .author-info -->

            </div><!-- end .author-bio -->


            <?php comments_template(); ?>

            <?php capstone_content_nav( 'nav-below' );?>

        <?php } ?>

        </div><!-- end .c12 -->
    
    </div><!-- end .row -->
    
</div><!-- end .grid -->

<?php get_footer(); ?>