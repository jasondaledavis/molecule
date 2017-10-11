   <?php if ( is_active_sidebar( 'topbar-left' ) || is_active_sidebar( 'topbar-right' ) )  : ?>

            <div id="woody-topbar">
                
                <div class="grid">

                    <div class="row">

                        <div class="c6">

                            <div class="topbar-left">

                                <?php dynamic_sidebar( 'topbar-left' ); ?>

                            </div>
                            
                        </div>

                        <div class="c6">

                            <div class="topbar-right">
                                
                                <?php dynamic_sidebar( 'topbar-right' ); ?>

                            </div>
                            
                        </div>

                    </div><!-- end .row -->

                </div><!-- end .grid -->

            </div><!-- end #woody-topbar -->

            <?php endif; ?>