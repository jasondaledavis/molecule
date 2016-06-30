<?php
/**
 * The template for displaying 404 pages.
 *
 * @package molecule
 */
get_header( 'inner' ); ?>
<?php global $capstone_molecule; ?>
        <div class="grid">

            <div class="row">

                <div class="c6">

                    <?php $image = CAPSTONE_THEME_URI .'assets/img/404.jpg'; 
                    $alt = get_bloginfo( 'description' );
                    echo '<img src="'.$image.'" alt="'.$alt.'" />'; ?>

                </div><!-- end .c6 -->

                <div class="c6">

                <h1 class="entry-title"><?php _e( 'Uh Oh!!', 'molecule' ); ?></h1>
                    <h3><?php _e( 'This is not the page you\'re looking for.', 'molecule' ); ?></h3>

                    <p><?php _e( 'Please use the button below to jump to the Homepage.', 'molecule' ); ?></p>

                    <p><a class="read-more" href="<?php echo home_url(); ?>"><?php _e( 'Go to the homepage', 'molecule' ); ?></a></p>
                </div>

            </div><!-- end .row -->

            <div class="row">
                <div class="c9">
                <br/>
                      <h3><?php _e( 'Or perhaps something below will help...', 'molecule' ); ?></h3>
                        <?php
                        $args = array( 'posts_per_page' => 3 );
                        $lastposts = get_posts( $args );
                        foreach ( $lastposts as $post ) :
                          setup_postdata( $post ); ?>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php the_excerpt(); ?><a class="read-more" href="<?php the_permalink(); ?>"><?php _e( 'Read Article', 'molecule' ); ?></a>
                        <?php endforeach; 
                        wp_reset_postdata(); ?>
                </div>
                <div class="c3">
                    <?php get_sidebar(); ?>
                </div>
            </div>

        </div><!-- end .grid -->

<?php get_footer(); ?>