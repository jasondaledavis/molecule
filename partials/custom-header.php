<?php
/**
 * The template part for displaying an custom header thumbnail
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
?>
<div class="custom-header">

<div class="header-pattern"></div>

    <?php 

        // If the current page is a static page or post
        if ( is_page() || is_single() || is_singular( 'jetpack-portfolio' ) || is_singular( 'jetpack-testimonials' ) ) {

        if ( has_post_thumbnail() ) {

         the_post_thumbnail( 'header-image', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); 

        } else {  
            $image = get_template_directory_uri() .'/assets/img/header_placeholder.jpg'; 
            $alt = get_bloginfo( 'description' );
            echo '<img src="'.$image.'" alt="'.$alt.'" />';
        }

    // If the current page is the posts index page
    } else if ( is_home() ) {

        $image = get_template_directory_uri() .'/assets/img/header_placeholder.jpg'; 
        $alt = get_bloginfo( 'description' );
        echo '<img src="'.$image.'" alt="'.$alt.'" />';

    // If the current page is the 404, archive or search results page (pulls in header image set on blog index)
    } else if ( is_404() || is_archive() || is_search() ) {

        $image = get_template_directory_uri() .'/assets/img/header_placeholder.jpg'; 
        $alt = get_bloginfo( 'description' );
        echo '<img src="'.$image.'" alt="'.$alt.'" />';
       
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

    <?php } elseif ( is_front_page() || is_home() ) { ?>

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

    <?php } elseif ( is_single() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php the_title(); ?></h1>
            
            <?php get_template_part( 'partials/single-meta', 'details' ); ?>

        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( class_exists( 'WooCommerce' ) ) if ( is_shop() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php woocommerce_page_title(); ?></h1>

        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( class_exists( 'WooCommerce' ) ) if ( is_shop() || is_woocommerce()) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php woocommerce_page_title(); ?></h1>

        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_category() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( 'Posts in Category: ', 'molecule' ); ?><?php single_cat_title(); ?></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_author() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><?php _e( 'Posts by: ', 'molecule' ); ?><?php echo get_the_author(); ?></h1>

            <?php   

                $author_avatar_size = apply_filters( 'molecule_author_avatar_size', 120 );
                printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
                get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
                _x( 'Author', 'Used before post author name.', 'molecule' ),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
                ); 

            ?>

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