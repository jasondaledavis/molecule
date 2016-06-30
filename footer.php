<?php global $capstone_molecule; ?>

</main><!-- end .page-content -->

    <footer class="footer-global">

        <div class="grid">

            <div class="row">

                <div class="c4">

                        <p class="copyright-info">&copy; <?php echo date( 'Y' ) ?> <?php echo $capstone_molecule['footer-copyright']; ?></p>

                </div><!-- end .c4 -->

                <div class="c4">

                        <?php get_template_part( 'partials/social', 'icons' ); ?>

                </div><!-- end .c4 -->

                <div class="c4">

                       <p class="text-right"><span><?php echo bloginfo( 'name' ); ?> <?php echo bloginfo( 'description' ); ?></span>.</p>

                </div> <!-- end .c4 -->

            </div><!-- end .row -->

        </div><!-- end .grid -->

    </footer><!-- end .footer-global -->

        <?php if ( isset( $capstone_molecule['google-tracking-code'] ) && '' != $capstone_molecule['google-tracking-code'] ) echo $capstone_molecule['google-tracking-code']; ?>

    <?php wp_footer(); ?>
    
    </body>

</html>