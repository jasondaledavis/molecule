<?php global $capstone_molecule; ?>

</main><!-- end .page-content -->

    <footer class="footer-global">

        <div class="grid">

            <div class="row">

                <div class="footer-credits">

                    <div class="c6">

                        <p class="copyright-info"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>. &copy; <?php echo date( 'Y' ) ?> <?php echo $capstone_molecule['footer-copyright']; ?></p>

                    </div><!-- end .c6 -->

                    <div class="c6">

                        <p class="text-right"><a href="<?php echo esc_url( __( 'https://element502.com/', 'molecule' ) ); ?>" target="_blank" alt="A Louisville Web Design and Digital Advertising Agency" title="The stuff that makes Element 502 themes awesome."><?php printf( __( 'Proudly powered by %s', 'molecule' ), 'Elementium #502' ); ?></a></p>

                    </div> <!-- end .c6 -->

                </div>

            </div><!-- end .row -->

        </div><!-- end .grid -->

    </footer><!-- end .footer-global -->

        <?php if ( isset( $capstone_molecule['google-tracking-code'] ) && '' != $capstone_molecule['google-tracking-code'] ) echo $capstone_molecule['google-tracking-code']; ?>

    <?php wp_footer(); ?>
    
    </body>

</html>