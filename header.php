<?php global $capstone_molecule; ?>
<?php get_template_part( 'partials/head', 'meta' ); ?>

    <body <?php body_class(); ?> >
    
        <header class="header-global">

            <div class="header-top">

                <div class="grid">

                    <div class="row">
                        
                        <div class="c12">
                        
                            <div class="logo" style="margin-top: <?php echo $capstone_molecule['general-logo-margins']['margin-top']; ?>; margin-bottom: <?php echo $capstone_molecule['general-logo-margins']['margin-bottom']; ?>;">

                            <?php if ( $capstone_molecule['general-text-logo'] ) { ?>
                                <h1 class="text-logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php } elseif ( $capstone_molecule['general-logo-standard'] ) { ?>
                                <span class="image-logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'description' ); ?>"><img src="<?php echo $capstone_molecule['general-logo-standard']['url']; ?>" alt="<?php bloginfo( 'description' ); ?>"/></a></span>
                            <?php } ?>

                            <div class="desc"><?php echo bloginfo( 'description' ); ?></div>

                            </div><!-- end .logo -->
                            
                        </div><!-- end .c12 -->

                    </div><!-- end .row -->

                    <div class="row">
                        
                        <div class="c12">
                        
                            <nav class="header-navigation">
                                <?php
                                    wp_nav_menu( array(
                                        'theme_location' => 'main',
                                        'container'      => '',
                                        'menu_class' => 'capstonemenu'
                                    ) );
                                ?>
                            </nav><!-- end .header-navigation -->
                            
                        </div><!-- end .c12 -->

                    </div><!-- end .row -->

                </div><!-- end .grid .wfull -->

            </div><!-- end .header-top -->

        </header><!-- end .header-global -->
       
        <main class="page-content" role="main">