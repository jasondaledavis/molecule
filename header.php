<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "page-content" div.
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */

?>
<?php get_template_part( 'partials/head', 'meta' ); ?>

    <body <?php body_class(); ?> >
    
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'molecule' ); ?></a>
        <header id="masthead" class="header-global">

                <?php if ( get_header_image() ) : ?>

                <?php
                    /**
                     * Filter the default molecule custom header sizes attribute.
                     *
                     * @since Molecule 1.0
                     *
                     * @param string $custom_header_sizes sizes attribute
                     * for Custom Header. Default '(max-width: 709px) 85vw,
                     * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
                     */
                    $custom_header_sizes = apply_filters( 'molecule_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px' );
                ?>

            <div class="header-top" style="background:url('<?php header_image(); ?>')">

        <?php else : ?>

            <div class="header-top">
                        
            <?php endif; // End header image check. ?>

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

                            <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            
                            <button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'molecule' ); ?></button>

                            <div id="site-header-menu" class="site-header-menu">
                                    <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'molecule' ); ?>">
                                        <?php
                                            wp_nav_menu( array(
                                                'theme_location' => 'primary',
                                                'menu_class'     => 'primary-menu',
                                             ) );
                                        ?>
                                    </nav><!-- .main-navigation -->

                            </div><!-- .site-header-menu -->

                            <?php endif; ?><!-- end has_nav_menu -->

                        </div><!-- end .c12 -->

                    </div><!-- end .row -->

                </div><!-- end .grid -->

            </div>

            </div><!-- end .header-top -->

            <!-- If an interior page -->
            <?php if ( !is_front_page() ) : ?>

            <div class="grid wfull">

                <div class="row">
                
                    <?php get_template_part( 'partials/custom', 'header' ); ?>               

                </div>

            </div>

            <?php endif; ?>

        </header><!-- end .header-global -->
       
        <main class="page-content">