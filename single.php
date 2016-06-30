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

                    <?php if ( is_singular(array('post')) ) { ?>

                        <?php get_template_part( 'partials/social', 'share' ); ?>

                    <?php } ?>

                    <div class="post-tags">
                        
                        <p class="tag-title">tags:</p><?php the_tags( ' ',' ' ); ?>
                    
                    </div>

                </div>

                <?php wp_link_pages(); ?>

            </article><!-- end .post-single -->

        <?php endwhile; endif; ?>

            <div class="blog-content-btm">

                <div class="grid wfull">

                    <div class="row">
                        
                        <div class="c12">

                        <?php if ( !is_singular( array('page', 'attachment', 'post') ) ){ ?>

                            <ul class="project-nav">
                                <li class="prev"><?php next_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?></li>
                                <li class="back"><a href="<?php echo get_permalink($capstone_molecule['general-portfolio-page']); ?>"><i class="fa fa-th"></i></a></li>
                                <li class="next"><?php previous_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?></li>
                            </ul><!-- .project-nav -->

                        <?php //} elseif ( is_singular() ) { ?>

                            <?php //if ( is_active_sidebar( 'blog-below-content' )  ) : ?>

                            <?php //if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "blog-below-content" ) ) : ?>

                            <?php// endif; ?>

                            <?php //endif; ?>

                        <?php } ?>

                        </div>

                    </div>

                </div>

            </div>

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