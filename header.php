<?php global $capstone_molecule; ?>
<?php get_template_part( 'partials/head', 'meta' ); ?>

    <body <?php body_class(); ?> >
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'molecule' ); ?></a>
        <header id="masthead" class="header-global">

            <div class="header-top">

                <div class="grid">

                    <div class="row">
                        
                        <div class="c12">
                        
                            <div class="logo">

                                <?php molecule_the_custom_logo(); ?>

                                <?php if ( is_front_page() && is_home() ) : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php else : ?>
                                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php endif;

                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo $description; ?></p>
                                <?php endif; ?>

                            </div><!-- end .logo -->
                    
                            <div class="site-header-main">

                            <?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
                            
                            <button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'molecule' ); ?></button>

                            <div id="site-header-menu" class="site-header-menu">
                                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                    <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'molecule' ); ?>">
                                        <?php
                                            wp_nav_menu( array(
                                                'theme_location' => 'primary',
                                                'menu_class'     => 'primary-menu',
                                             ) );
                                        ?>
                                    </nav><!-- .main-navigation -->
                                <?php endif; ?>

                            </div><!-- .site-header-menu -->

                            <?php endif; ?>

                        </div><!-- end .c12 -->

                    </div><!-- end .row -->

                </div><!-- end .grid .wfull -->

            </div><!-- end .header-top -->

        </header><!-- end .header-global -->
       
        <main class="page-content" role="main">