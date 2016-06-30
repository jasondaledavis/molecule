<?php global $capstone_molecule; ?>
<?php if ( is_woocommerce() ) { ?>

    <div class="custom-headings">
        <div class="custom-headings-inner">
            <div class="avatar">
            <?php
            global $post;
            $author_id=$post->post_author;
            echo get_avatar($author_id, 110);
            ?>
            </div>
            <h1 class="page-title entry-title"><?php the_title(); ?></h1>
            <?php $username = get_userdata( $post->post_author ); ?>

           <h2 class="page-subtitle"><i class="fa fa-user"></i> <?php _e( ' Article by', 'molecule' ); ?> <span><?php echo $username->display_name; ?> </span><i class="fa fa-clock-o"></i> on <span><?php the_time( 'jS F, Y' ); ?></span></h2> 
        </div>
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_product() ) { ?>

    <div class="custom-headings">
        <div class="custom-headings-inner">
           
            <h1 class="page-title entry-title"><?php the_title(); ?></h1>
           
        </div>
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_product_category() ) { ?>

    <div class="custom-headings">
        <div class="custom-headings-inner">
            <h1 class="page-title entry-title"><?php _e( 'Category: ', 'molecule' ); ?><?php single_cat_title(); ?></h1>
        </div>
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_product_tag() ) { ?>

    <div class="custom-headings">
        <div class="custom-headings-inner">
            <h1 class="page-title entry-title"><?php _e( 'Posts Tagged with:', 'molecule' ); ?><?php single_tag_title(); ?></h1>
        </div>
    </div><!-- end .custom-headings -->

    <?php } elseif ( is_shop() ) { ?>
    <div class="custom-headings">
        <div class="custom-headings-inner">
            <?php if ( get_post_meta( $post->ID, 'capstone_page_heading', true ) ) { ?>
          <h1 class="page-title"><?php echo get_post_meta($post->ID, 'capstone_page_heading', true) ?></h1>
            <?php } else { ?>
            <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
            <?php } ?>
           <h2 class="page-subtitle"><?php echo get_post_meta($post->ID, 'capstone_page_subtitle', true) ?></h2>
        </div>
    </div><!-- end .custom-headings -->

    <?php }?>