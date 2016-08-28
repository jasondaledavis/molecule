<?php global $capstone_molecule; ?>

<div class="custom-header">

    <?php
    // If the current page is a static page or post
    if ( is_page() || is_single() || is_singular( 'jetpack-portfolio' ) || is_singular( 'jetpack-testimonials' ) ) {
        if ( class_exists( 'MultiPostThumbnails' ) && 
        ( MultiPostThumbnails::has_post_thumbnail( get_post_type(), 'header-image' , get_the_ID() ) ) ) { 
        MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'header-image', NULL, 
            'header-image-full', 
            array('class' => "custom-header-image") ); 

        } else {  
            $image = get_template_directory_uri() .'/assets/img/placeholders/header_placeholder.jpg'; 
            $alt = get_bloginfo( 'description' );
            echo '<img src="'.$image.'" alt="'.$alt.'" />';
        }    

    // If the current page is the posts index page
    } else if ( is_home() ) {

        if ( class_exists( 'MultiPostThumbnails' ) && 
        ( MultiPostThumbnails::has_post_thumbnail( 'page', 'header-image' , get_option('page_for_posts') ) ) ) {
        MultiPostThumbnails::the_post_thumbnail( 'page', 'header-image', get_option('page_for_posts'),
            'header-image-full', 
            array('class' => "custom-header-image") ); 

        } else {  
            $image = get_template_directory_uri() .'/assets/img/placeholders/header_placeholder.jpg'; 
            $alt = get_bloginfo( 'description' );
            echo '<img src="'.$image.'" alt="'.$alt.'" />';
        }

    // If the current page is the 404, archive or search results page (pulls in header image set on blog index)
    } else if ( is_404() || is_archive() || is_search() ) {

        if ( class_exists( 'MultiPostThumbnails' ) && 
        ( MultiPostThumbnails::has_post_thumbnail( 'page', 'header-image' , get_option('page_for_posts') ) ) ) {
        MultiPostThumbnails::the_post_thumbnail( 'page', 'header-image', get_option('page_for_posts'),
            'header-image-full', 
            array('class' => "custom-header-image") ); 

        } else {  
            $image = get_template_directory_uri() .'/assets/img/placeholders/header_placeholder.jpg'; 
            $alt = get_bloginfo( 'description' );
            echo '<img src="'.$image.'" alt="'.$alt.'" />';
        }

    } ?>

    <?php if ( is_page() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <?php if ( get_post_meta( $post->ID, 'capstone_page_heading', true ) ) { ?>

            <h1 class="page-title entry-title"><?php echo get_post_meta($post->ID, 'capstone_page_heading', true) ?></h1>

            <?php } else { ?>

            <h1 class="page-title entry-title"><?php the_title(); ?></h1>
            <?php } ?>

            <h2 class="page-subtitle"><?php echo get_post_meta($post->ID, 'capstone_page_subtitle', true) ?></h2>
            
        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_home() ) { ?>

    <?php
    $page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID );
    ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <?php if ( get_post_meta( $page_id, 'capstone_page_heading', true ) ) { ?>

            <h1 class="page-title entry-title"><?php echo get_post_meta( $page_id, 'capstone_page_heading', true ); ?></h1>
            
            <?php } else { ?>

            <h1 class="page-title entry-title"><?php echo get_the_title( get_option('page_for_posts', true) ); ?></h1>
          
            <?php } ?>

            <h2 class="page-subtitle"><?php echo get_post_meta($post->ID, 'capstone_page_subtitle', true) ?></h2>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( class_exists( 'WooCommerce' ) ) { ?>

    <?php get_template_part( 'partials/woo', 'header' ); ?>

    <?php } elseif ( is_singular( 'jetpack-portfolio' ) || is_singular( 'jetpack-testimonials' ) ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php the_title(); ?></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_single() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php the_title(); ?></h1>

            <?php $username = get_userdata( $post->post_author ); ?>
           
           <p class="page-subtitle"><i class="fa fa-pencil"></i> <?php _e( ' Posted by', 'molecule' ); ?><span class="author"> <?php echo $username->display_name; ?> </span></p> 

            <?php get_template_part( 'partials/single-meta', 'details' ); ?>

        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_category() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( 'Posts in Category: ', 'molecule' ); ?><?php single_cat_title(); ?></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_404() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( '404 - Page not found', 'molecule' ); ?></h1>
           
        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_tag() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( 'Posts Tagged with:', 'molecule' ); ?><?php single_tag_title(); ?></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_search() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e('Search Results For: ', 'molecule');?><?php the_search_query() ?></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_day() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( 'Daily Archives:', 'molecule' ); ?><span class="updated"><?php the_time( 'F jS, Y' ); ?></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_month() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( 'Monthly Archives:', 'molecule' ); ?><span class="updated"><?php the_time( 'F, Y' ); ?></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_year() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( 'Yearly Archives:', 'molecule' ); ?><span class="updated"><?php the_time( 'Y' ); ?></span></h1>

        </div>
        
    </div><!-- end .custom-headings -->
   
    <?php }?>

</div><!-- end .custom-header -->