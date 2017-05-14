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

         the_post_thumbnail( 'header-image', array( 'alt' => the_title_attribute( 'echo=0' ), 'class' => "custom-header-image" ) ); 

        } else {  
            $image = get_template_directory_uri() .'/assets/img/header_placeholder.png'; 
            $alt = get_bloginfo( 'description' );
            echo '<img src="'.$image.'" alt="'.$alt.'" />';
        }

    // If the current page is the posts index page
    } else if ( is_home() ) {

        $image = get_template_directory_uri() .'/assets/img/header_placeholder.png'; 
        $alt = get_bloginfo( 'description' );
        echo '<img src="'.$image.'" alt="'.$alt.'" />';

    // If the current page is the 404, archive or search results page (pulls in header image set on blog index)
    } else if ( is_404() || is_archive() || is_search() ) {

        $image = get_template_directory_uri() .'/assets/img/header_placeholder.png'; 
        $alt = get_bloginfo( 'description' );
        echo '<img src="'.$image.'" alt="'.$alt.'" />';
       
    } ?>

    <?php if ( is_page() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <?php if ( get_post_meta( $post->ID, 'molecule_page_heading', true ) ) { ?>

            <h1 class="page-title"><span class="entry-title"><?php echo get_post_meta($post->ID, 'molecule_page_heading', true) ?></span></h1>

            <?php } else { ?>

            <h1 class="page-title"><span class="entry-title"><?php the_title(); ?></span></h1>
            <?php } ?>

            <h2 class="page-subtitle"><?php echo get_post_meta($post->ID, 'molecule_page_subtitle', true) ?></h2>
            
        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_front_page() || is_home() ) { ?>

    <?php
    $page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID );
    ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <?php if ( get_post_meta( $page_id, 'molecule_page_heading', true ) ) { ?>

            <h1 class="page-title"><span class="entry-title"><?php echo get_post_meta( $page_id, 'molecule_page_heading', true ); ?></span></h1>
            
            <?php } else { ?>

            <h1 class="page-title"><span class="entry-title"><?php echo get_the_title( get_option('page_for_posts', true) ); ?></span></h1>
          
            <?php } ?>

            <h2 class="page-subtitle"><?php echo get_post_meta($post->ID, 'molecule_page_subtitle', true) ?></h2>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( class_exists( 'WooCommerce' ) && is_woocommerce() && is_shop() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner"> 

        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

            <h1 class="page-title"><span class="entry-title"><?php woocommerce_page_title(); ?></span></h1>

        <?php endif; ?>

        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( class_exists( 'WooCommerce' ) && is_product_category() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner"> 

        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

            <h1 class="page-title">Product Category: <span class="entry-title"><?php woocommerce_page_title(); ?></span></h1>

        <?php endif; ?>

        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_single() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php the_title(); ?></span></h1>


            <?php
            global $post;
            $author_id=$post->post_author;
            $username = get_userdata( $post->post_author ); 
            ?>

            <h2 class="page-subtitle"><span class="byline"><?php _e( 'Article by', 'molecule' ); ?> <span class="author vcard"><a class="url fn n" href="#"><?php echo $username->display_name; ?></a></span> on <span><span class="entry-date published updated"><?php the_time( 'F j, Y' ); ?></span></span></span></h2>

        </div>
        
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_category() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php _e( 'Posts in Category: ', 'molecule' ); ?><?php single_cat_title(); ?></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_author() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php _e( 'Posts by: ', 'molecule' ); ?><?php echo get_the_author(); ?></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_404() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php _e( '404 - Page not found', 'molecule' ); ?></span></h1>
           
        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_tag() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php _e( 'Posts Tagged with: ', 'molecule' ); ?><?php single_tag_title(); ?></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_search() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title entry-title"><span class="entry-title"><?php _e('Search Results For: ', 'molecule');?><?php the_search_query() ?></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_day() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php _e( 'Daily Archives:', 'molecule' ); ?><span class="updated"><?php the_time( 'F jS, Y' ); ?></span></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_month() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php _e( 'Monthly Archives:', 'molecule' ); ?><?php single_month_title( ' ', 'molecule' ); ?> <span class="updated"><?php the_time( 'F, Y' ); ?></span></span></h1>

        </div>

    </div><!-- end .custom-headings -->

    <?php } elseif ( is_year() ) { ?>

    <div class="custom-headings">

        <div class="custom-headings-inner">

            <h1 class="page-title"><span class="entry-title"><?php _e( 'Yearly Archives:', 'molecule' ); ?><span class="updated"><?php the_time( 'Y' ); ?></span></span></h1>

        </div>
        
    </div><!-- end .custom-headings -->
   
    <?php }?>

</div><!-- end .custom-header -->