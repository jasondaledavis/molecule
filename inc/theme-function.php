<?php
/**
 * Molecule specific theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 1.0
 */
//================================================================================//
// TGM Plugin Activation
//================================================================================//
require get_template_directory() . '/inc/tgm-plugin-activation/init.php';
//================================================================================//
// Register WooCommerce and check if activated.
//================================================================================//
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
}

add_action( 'after_setup_theme', 'woocommerce_support' );
//================================================================================//
// Add Title/Subtitle Meta Box to all Pages
//================================================================================//
$prefix = 'molecule_';
 
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

add_action('admin_menu', 'molecule_add_box_strapline');

//================================================================================//
//  Callback function to show fields in meta box
//================================================================================//
function molecule_show_box_strapline() {
    global $meta_box_strapline, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="molecule_add_box_strapline_nonce" value="', wp_create_nonce( basename( __FILE__ ) ), '" />';

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

add_action( 'save_post', 'molecule_save_data_strapline' );

//================================================================================//
//  Add metabox to edit page
//================================================================================//
function molecule_add_box_strapline() {
    global $meta_box_strapline;
    
    add_meta_box($meta_box_strapline['id'], $meta_box_strapline['title'], 'molecule_show_box_strapline', $meta_box_strapline['page'], $meta_box_strapline['context'], $meta_box_strapline['priority']);
}
// Save data from meta box
function molecule_save_data_strapline($post_id) {
    global $meta_box_strapline;

    // verify nonce
    if ( !isset($_POST['molecule_add_box_strapline_nonce']) || !wp_verify_nonce($_POST['molecule_add_box_strapline_nonce'], basename(__FILE__))) {
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
//Add SVG to allowed file uploads
//================================================================================//
function molecule_add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'molecule_add_file_types_to_uploads');