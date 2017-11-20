<?php
/**
 * The template for the content bottom widget areas on posts and pages
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>
        <div class="footer-widgets">

            <div class="grid wfull">

                <div class="row"> 

                    <?php if ( is_active_sidebar( 'sidebar-footer-1' )  ) : ?>

                    <div class="c3">

                        <?php dynamic_sidebar( 'sidebar-footer-1' ); ?>

                    </div>

                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'sidebar-footer-2' )  ) : ?>

                    <div class="c3">

                        <?php dynamic_sidebar( 'sidebar-footer-2' ); ?>

                    </div>

                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'sidebar-footer-3' )  ) : ?>

                    <div class="c3">

                        <?php dynamic_sidebar( 'sidebar-footer-3' ); ?>

                    </div>

                    <?php endif; ?>

                    <?php if ( is_active_sidebar( 'sidebar-footer-4' )  ) : ?>

                    <div class="c3">

                        <?php dynamic_sidebar( 'sidebar-footer-4' ); ?>

                    </div>

                    <?php endif; ?>

                </div><!-- end .row -->

            </div><!-- end .grid -->

        </div>