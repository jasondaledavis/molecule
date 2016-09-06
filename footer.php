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

<?php get_sidebar( 'footer-widgets' ); ?>

    <footer class="footer-global">

        <div class="grid">

            <div class="row">

                <div class="footer-credits">

                    <div class="c6">

                        <p class="copyright-info"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>. &copy; <?php echo date( 'Y' ) ?> <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'molecule' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'molecule' ), 'WordPress' ); ?></a></p>

                    </div><!-- end .c6 -->

                    <div class="c6">

                        <p class="text-right"><a href="<?php echo esc_url( __( 'https://element502.com/', 'molecule' ) ); ?>" target="_blank" alt="A Louisville Web Design and Digital Advertising Agency" title="The stuff that makes Element 502 themes awesome."><?php printf( __( 'Also powered by %s', 'molecule' ), 'Elementium #502' ); ?></a></p>

                    </div> <!-- end .c6 -->

                </div>

            </div><!-- end .row -->

        </div><!-- end .grid -->

    </footer><!-- end .footer-global -->

    <?php wp_footer(); ?>
    
    </body>

</html>