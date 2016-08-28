<?php
//================================================================================//
// Fix for Chrome password field empty bug
//================================================================================//
add_action("login_form", "kill_wp_attempt_focus");
function kill_wp_attempt_focus() {
    global $error;
    $error = TRUE;
}
//================================================================================//
// custom blog function to declare blog page
//================================================================================//
function is_blog() {
  if (is_home() || is_post_type_archive( 'post' ))
    return true;
  else return false;
}
//================================================================================//
// Configure settings for Multi Post Thumbnails
//================================================================================//
if (class_exists('MultiPostThumbnails')) {
    $types = array('post', 'page');
    foreach($types as $type) {
        new MultiPostThumbnails(array(
            'priority' => 'high',
            'label' => 'Header Image',
            'id' => 'header-image',
            'post_type' => $type,
            'new_width' => 254,
            'new_height' => 254
            )
        );
    }
}
//================================================================================//
// Checks to see if appropriate templates are present in active template directory.
// Otherwises uses templates present in plugin's template directory.
//================================================================================//
add_filter('template_include', 'molecule_set_template');
function molecule_set_template( $template ){

    /* 
     * Optional: Have a plug-in option to disable template handling
     * if( get_option('wpse72544_disable_template_handling') )
     *     return $template;
     */

    if(is_singular('lander') && 'single-lander.php' != $template ){
        //WordPress couldn't find an 'event' template. Use plug-in instead:
        $template = WP_PLUGIN_DIR . '/elements/single-lander.php';
    }

    return $template;

    if(is_singular('ty') && 'single-ty.php' != $templatety ){
        //WordPress couldn't find an 'event' template. Use plug-in instead:
        $templatety = WP_PLUGIN_DIR . '/elements/single-ty.php';
    }

    return $templatety;
}

add_filter('template_include', 'molecule_set_templatety');
function molecule_set_templatety( $templatety ){

    /* 
     * Optional: Have a plug-in option to disable template handling
     * if( get_option('wpse72544_disable_template_handling') )
     *     return $template;
     */

    if(is_singular('ty') && 'single-ty.php' != $templatety ){
        //WordPress couldn't find an 'event' template. Use plug-in instead:
        $templatety = WP_PLUGIN_DIR . '/elements/single-ty.php';
    }

    return $templatety;
}

//================================================================================//
// Add Title/Subtitle Meta Box to all Pages
//================================================================================//
$prefix = 'capstone_';
 
$meta_box_strapline = array(
    'id' => 'strapline',
    'title' => __('Custom Header Settings', 'molecule'),
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'default',
    'fields' => array(
        array(
            'name' => __( 'Heading', 'molecule' ),
            'desc' => __('Enter a header title to appear over your header image<br />(ie; My page title)', 'molecule'),
            'id' => $prefix . 'page_heading',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __( 'Subtitle', 'molecule' ),
            'desc' => __('Enter a subtitle to appear over your header image<br />(ie; My page subtitle)', 'molecule'),
            'id' => $prefix . 'page_subtitle',
            'type' => 'text',
            'std' => ''
        )
        
    )
);

add_action('admin_menu', 'capstone_add_box_strapline');

//================================================================================//
//  Callback function to show fields in meta box
//================================================================================//
function capstone_show_box_strapline() {
    global $meta_box_strapline, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="capstone_add_box_strapline_nonce" value="', wp_create_nonce( basename( __FILE__ ) ), '" />';

    echo '<table class="form-table">';
        
    foreach ( $meta_box_strapline['fields'] as $field ) {
        // get current post meta data
        $meta = get_post_meta( $post->ID, $field['id'], true );
        switch ( $field['type'] ) {
 
            
            //If Text       
            case 'text':
            
            echo '<tr style="border-bottom:1px solid #eeeeee;">',
                '<th style="width:25%; font-weight: normal;"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><p style=" display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</p></label></th>',
                '<td>';
            echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
            
            break;
            
            //If textarea       
            case 'textarea':
            
            echo '<tr>',
                '<th style="width:25%; font-weight: normal;"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><p style="line-height:18px; display:block; color:#666; margin:5px 0 0 0;">'. $field['desc'].'</p></label></th>',
                '<td>';
            echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" rows="4" cols="5" style="width:75%; margin-right: 20px; float:left;">', $meta ? $meta : $field['std'], '</textarea>';
            
            break;
 
            //If Button 
            case 'button':
                echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '"value="', $meta ? $meta : $field['std'], '" />';
                echo    '</td>',
            '</tr>';
            
            break;
            
            //If Select 
            case 'select':
            
                echo '<tr>',
                '<th style="width:25%; font-weight: normal;"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><p style=" display:block; color:#666; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</p></label></th>',
                '<td>';
            
                echo'<select id="' . $field['id'] . '" name="'.$field['id'].'">';
            
                foreach ($field['options'] as $option) {
                    
                    echo'<option';
                    if ($meta == $option ) { 
                        echo ' selected="selected"'; 
                    }
                    echo'>'. $option .'</option>';
                
                } 
                
                echo'</select>';
            
            break;
        }

    }
 
    echo '</table>';
}

add_action( 'save_post', 'capstone_save_data_strapline' );

//================================================================================//
//  Add metabox to edit page
//================================================================================//
function capstone_add_box_strapline() {
    global $meta_box_strapline;
    
    add_meta_box($meta_box_strapline['id'], $meta_box_strapline['title'], 'capstone_show_box_strapline', $meta_box_strapline['page'], $meta_box_strapline['context'], $meta_box_strapline['priority']);
}
// Save data from meta box
function capstone_save_data_strapline($post_id) {
    global $meta_box_strapline;

    // verify nonce
    if ( !isset($_POST['capstone_add_box_strapline_nonce']) || !wp_verify_nonce($_POST['capstone_add_box_strapline_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box_strapline['fields'] as $field) { // save each option
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) { // compare changes to existing values
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}
//================================================================================//
// Custom Navigation for Single Posts
//================================================================================//
if (! function_exists( 'capstone_content_nav' )):
//Display navigation to next/previous pages when applicable
function capstone_content_nav( $nav_id ) {
global $wp_query;

?>

<?php if ( is_single() ) : // navigation links for single posts ?>
<ul class="pager">
    <?php previous_post_link( '<li class="previous">%link</li>', '<span class="meta-nav">' . _x('<i class="fa fa-angle-left"></i>&nbsp;&nbsp;', 'Previous post link', 'molecule') . '</span>Previous Article ' ); ?>
    <?php next_post_link( '<li class="next">%link</li>', 'Next Article<span class="meta-nav"> ' . _x('&nbsp;&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'molecule') . '</span>' ); ?>
</ul>

<?php endif; ?>

<?php
}
endif;

//================================================================================//
// Numbered Post Navigation (for Post Index, Archives, and Search Results)
//================================================================================//
function wp_pagenavi() {
  
  global $wp_query, $wp_rewrite;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if ( !$current = get_query_var( 'paged' ) ) $current = 1;
  $args['base'] = str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) );
  $args['total'] = $max;
  $args['current'] = $current;
 
  $total = 1;
  $args['mid_size'] = 3;
  $args['end_size'] = 1;
  $args['prev_text'] = '<';
  $args['next_text'] = '>';
 
  if ( $max > 1 ) echo '</pre>
    <div class="pagination">';
 echo $pages . paginate_links( $args );
 if ( $max > 1 ) echo '</div>';

}

//================================================================================//
// Custom function for the Excerpt and Content
//================================================================================//
// function excerpt($limit) {
//     $excerpt = explode(' ', get_the_excerpt(), $limit);
//     if (count($excerpt)>=$limit) {
//         array_pop($excerpt);
//         $excerpt = implode(" ",$excerpt).'...';
//     } else {
//         $excerpt = implode(" ",$excerpt);
//     }    
//     $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
// return $excerpt;
// }
 
// function content($limit) {
//     $content = explode(' ', get_the_content(), $limit);
//     if (count($content)>=$limit) {
//         array_pop($content);
//         $content = implode(" ",$content).'...';
//     } else {
//         $content = implode(" ",$content);
//     }    
//     $content = preg_replace('/\[.+\]/','', $content);
//     $content = apply_filters('the_content', $content); 
//     $content = str_replace(']]>', ']]&gt;', $content);
// return $content;
// }

// function custom_excerpt_length( $length ) {
//     return 35; //change here for chanacter length of excerpt
// }
// add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//================================================================================//
// Add custom fields to Author Bio
//================================================================================//
function capstone_add_to_author_profile($contactmethods) {
    
    $contactmethods['twitter_profile'] = 'Twitter Profile URL';
    $contactmethods['facebook_profile'] = 'Facebook Profile URL';
    $contactmethods['google_profile'] = 'Google Profile URL';
    $contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
    
    return $contactmethods;
}

add_filter( 'user_contactmethods', 'capstone_add_to_author_profile', 10, 1 );

//================================================================================//
// Custom Search Filter For Blog (Returns only Posts)
//================================================================================//
function capstone_search_filter($query) {
    if ($query->is_search && !is_admin() ) {
        $query->set( 'post_type', array( 'post' ) );
    }
    return $query;
}
add_filter( 'pre_get_posts', 'capstone_search_filter' );

//================================================================================//
//Search URL Re-Write
//================================================================================//
function molecule_change_search_url_rewrite() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }    
}
add_action( 'template_redirect', 'molecule_change_search_url_rewrite' );

//================================================================================//
// SVG Upload Ability
//================================================================================//
// function capstone_mime_types( $mimes ){
// $mimes['svg'] = 'image/svg+xml';
// return $mimes;
// }
// add_filter( 'upload_mimes', 'capstone_mime_types' );

//================================================================================//
// Security Enhancements
//================================================================================//
//remove wp name generator
remove_action('wp_head', 'wp_generator');

// check for Visual Composer is activated, if so then remove the meta generator tag.
if ( class_exists( 'Vc_Manager' ) ) {
    function myoverride() {
        remove_action('wp_head', array(visual_composer(), 'addMetaData'));
    }
    add_action('init', 'myoverride', 100);
}
//================================================================================//
// Change Sub-Menu Class
//================================================================================//
function change_submenu_class($menu) {  
  $menu = preg_replace('/ class="sub-menu"/',' class="dropdown"',$menu);  
  return $menu;  
}  
add_filter('wp_nav_menu','change_submenu_class');

//================================================================================//
// Enable Threaded Comments
//================================================================================//
// function capstone_enable_threaded_comments() {
//     if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
//        wp_enqueue_script('comment-reply');
//     }
// }
// add_action( 'get_header', 'capstone_enable_threaded_comments' );

//================================================================================//
// Custom function for the Comments
//================================================================================//
/* function capstone_comments( $comment, $args, $depth ) {
    $GLOBALS[ 'comment' ] = $comment;
?>
    <li class="comment">
    
        <div>
            
        <?php echo get_avatar( $comment, $size = '80' ); ?>
            
            <div class="comment-meta">
                <h5 class="author"><a href="<?php comment_author_url(); ?>" target="about_blank"><?php comment_author(); ?></a></h5>
                <p class="date"><?php _e( 'commented on', 'molecule' ); ?> <span><?php printf(__( '%1$s at %2$s', 'molecule' ), get_comment_date(),  get_comment_time()) ?></span></p>
            </div>
            
            <div class="comment-entry">
            <?php comment_text() ?>
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) ) ?>
            </div>
        
        </div>
        
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-moderate"><?php _e( 'Your comment is awaiting moderation.', 'molecule' ) ?></em>
            <br />
        <?php endif; ?>
        
        <?php edit_comment_link( __( '(Edit)', 'molecule' ),'  ','' ) ?>
        
<?php
}
*/
//================================================================================//
// Custom function for the Comment Form
//================================================================================//
// add_filter( 'comment_form_defaults', 'capstone_comment_form' );

// function capstone_comment_form( $form_options ) {

//     // Fields Array
//     $fields = array(
        
//         'author' =>
//         '<div class="c4">' .
//         '<input id="author" name="author" type="text" size="30" placeholder="' . __( 'Your Name (required)', 'molecule' ) . '" />' .
//         '</div>',

//         'email' =>
//         '<div class="c4">' .
//         '<input id="email" name="email" type="text" size="30" placeholder="' . __( 'Your Email (will not be published)', 'molecule' ) . '" />' .
//         '</div>',

//         'url' =>
//         '<div class="c4">'  .
//         '<input name="url" size="30" id="url" type="text" placeholder="' . __( 'Your Website (optional)', 'molecule' ) . '" />' .
//         '</div>',

//     );

//     // Form Options Array
//     $form_options = array(
//         // Include Fields Array
//         'fields' => apply_filters( 'comment_form_default_fields', $fields ),

//         // Template Options
//         'comment_field' =>
//         '<p class="comment-form-comment">' .
//         '<textarea name="comment" id="comment" aria-required="true" rows="8" cols="45" placeholder="' . __( 'Please leave your comment...', 'molecule' ) . '"></textarea>' .
//         '</p>',

//         'must_log_in' =>
//         '<p class="must-log-in">' .
//         sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'molecule' ),
//             wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) .
//         '</p>',

//         'logged_in_as' =>
//         '<p class="logged-in-as">' .
//         sprintf( __( 'You are currently logged in<a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'molecule' ),
//             admin_url( 'profile.php' ), (isset( $user_identity )), wp_logout_url( apply_filters('the_permalink', get_permalink() ) ) ) .
//         '</p>',

//         'comment_notes_before' => '',

//         'comment_notes_after' => '',

//         // Rest of Options
//         'id_form' => 'form-comment',
//         'id_submit' => 'submit',
//         'title_reply' => __( 'Please let us know your thoughts...', 'molecule' ),
//         'title_reply_to' => __( 'Leave a Reply to %s', 'molecule' ),
//         'cancel_reply_link' => __( 'Cancel reply', 'molecule' ),
//         'label_submit' => __( 'Post Comment Here', 'molecule' ),
//     );

//     return $form_options;
// }

//================================================================================//
// Register WooCommerce and check if activated.
//================================================================================//
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
}

add_action( 'after_setup_theme', 'woocommerce_support' );