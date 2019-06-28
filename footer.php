<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>

</main><!-- end .page-content -->

<?php get_template_part( 'template-parts/sidebar', 'footer' ); ?>

    <footer class="footer-global">

        <div class="grid">

            <div class="row">

                <div class="footer-credits">

                    <div class="c12">

                        <div class="footer-logo">

                            <?php molecule_the_custom_logo(); ?>

                                <?php if ( display_header_text() ) {
           
                                    if ( is_front_page() && is_home() ) : ?>
                                     
                                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                    
                                    <?php else : ?>
                                       
                                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                    
                                    <?php endif; 

                                } ?>

                                <?php
                                    if ( $url = get_privacy_policy_url() ) {
                                    echo '<span class="privacy-policy-page-link"><a href="' . esc_attr( $url ) . '" title="' . esc_html( 'Privacy Policy', 'molecule' ) . '">' . esc_html( 'Privacy Policy', 'molecule' ) . '</a></span>';
                                    }
                                ?>

                        </div>

                        <div class="copyright-info">

                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> &copy; <?php echo date( 'Y' ) ?>

                        </div>

                    </div><!-- end .c12 -->

                </div>

            </div><!-- end .row -->

        </div><!-- end .grid -->

    </footer><!-- end .footer-global -->

    <?php wp_footer(); ?>
    
    </body>

</html>