<?php
/**
 * The template for displaying archive pages.
 *
 * @package molecule
 */
get_header( 'inner' ); ?>

        <div class="grid">

            <div class="row">
                
                <div class="c12">
            
                    <div class="post-index">

                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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

                            <p><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read Article', 'molecule' ); ?></a></p>

                        </article><!-- end .post-excerpt -->

                    <?php endwhile; endif; ?>

                    <?php if( function_exists( 'wp_pagenavi' ) ) { ?>
                    <?php wp_pagenavi(); ?>   
                    <?php } else { ?>      
                        <?php posts_nav_link( '&#8734;','&laquo;&laquo; Previous Posts','Older Posts &raquo;&raquo;' ); ?>
                    <?php } ?>

                    </div><!-- end .post-index -->
                    
                </div><!-- end .c12 -->
                
            </div><!-- end .row -->

        </div><!-- end .grid -->

<?php get_footer(); ?>