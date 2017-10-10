<?php
/**
 * Woody functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
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
 * @subpackage Woody
 * @since Woody 1.0
 */
 
//================================================================================//
// Register the themes custom functions and supporting files/directories
//================================================================================//
require get_template_directory() . '/inc/theme-function.php';
/**
 * Woody only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
}
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

if ( ! function_exists( 'woody_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own woody_setup() function to override in a child theme.
 *
 * @since Woody 1.0
 */
function woody_setup() {

    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on Woody, use a find and replace
    * to change 'woody' to the name of your theme in all the template files
    */
    load_theme_textdomain( 'woody' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );

    /*
    * Enable support for custom logo.
    *
    * @since Woody 1.0
    */
    add_theme_support( 'custom-logo', array(
      'height'      => 240,
      'width'       => 240,
      'flex-height' => true,
      'flex-width' => true,
      'header-selector' => '.site-title a',
    ) );

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
    */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'post-thumbnail', 1200, 300, true ); // Post Thumbnail (appears on single and archives).
    add_image_size( 'header-image', 1200, 300, true ); // Interior Page Header Image

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'woody' ),
    ) );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

  /*
  * This theme styles the visual editor to resemble the theme style,
  * specifically font, colors, icons, and column width.
  */
  add_editor_style( array( 'assets/css/editor-style.css' ) );

  // Indicate widget sidebars can use selective refresh in the Customizer.
  add_theme_support( 'customize-selective-refresh-widgets' );

}
endif; // woody_setup

add_action( 'after_setup_theme', 'woody_setup' );

/**
* Sets the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width
*
* @since Woody 1.0
*/
function woody_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'woody_content_width', 1200 );
}
add_action( 'after_setup_theme', 'woody_content_width', 0 );

/**
* Registers a widget area.
*
* @link https://developer.wordpress.org/reference/functions/register_sidebar/
*
* @since Woody 1.0
*/
function woody_widgets_init() {

  register_sidebar( array(
    'name' => __('Blog Sidebar', 'woody' ),
    'id' => 'sidebar-blog',
    'description'   => __( 'Add widgets here to appear in your blog posts and page sidebar.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Page Sidebar', 'woody' ),
    'id' => 'sidebar-page',
    'description'   => __( 'Add widgets here to appear in your pages sidebar.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Footer Sidebar 1', 'woody' ),
    'id' => 'sidebar-footer-1',
    'description'   => __( 'Add widgets here to appear in your footer sidebar column one.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Footer Sidebar 2', 'woody' ),
    'id' => 'sidebar-footer-2',
    'description'   => __( 'Add widgets here to appear in your footer sidebar column two.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Footer Sidebar 3', 'woody' ),
    'id' => 'sidebar-footer-3',
    'description'   => __( 'Add widgets here to appear in your footer sidebar column three.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Footer Sidebar 4', 'woody' ),
    'id' => 'sidebar-footer-4',
    'description'   => __( 'Add widgets here to appear in your footer sidebar column four.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Top Sidebar Left', 'woody' ),
    'id' => 'topbar-left',
    'description'   => __( 'Add widgets here to appear in above your header in a sidebar on the left.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  register_sidebar( array(
    'name' => __('Top Sidebar Right', 'woody' ),
    'id' => 'topbar-right',
    'description'   => __( 'Add widgets here to appear in above your header in a sidebar on the right.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
  ) );

  if ( class_exists( 'WooCommerce' ) ) {
                 
    register_sidebar( array(
    'name' => __('Shop Sidebar', 'woody' ),
    'id'   => 'sidebar-shop',
    'description'   => __( 'Add widgets here to appear in your shop and products pages sidebar.', 'woody' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title' => '<h4 class="widget-title">',
    'after_title' => '</h4>',
    ) );

  } //end woo if

}

add_action( 'widgets_init', 'woody_widgets_init' );

/**
* Handles JavaScript detection.
*
* Adds a `js` class to the root `<html>` element when JavaScript is detected.
*
* @since Woody 1.0
*/
function woody_javascript_detection() {
echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'woody_javascript_detection', 0 );

/**
* Enqueues scripts and styles.
*
* @since Woody 1.0
*/

function woody_scripts() {

  // Add Genericons, used in the main stylesheet.
  wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

  // Theme stylesheet.
  wp_enqueue_style( 'woody-style', get_stylesheet_uri() );

  // Load the Internet Explorer specific stylesheet.
  wp_enqueue_style( 'woody-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'woody-style' ), '20160816' );
  wp_style_add_data( 'woody-ie', 'conditional', 'lt IE 10' );

  // Load the Internet Explorer 8 specific stylesheet.
  wp_enqueue_style( 'woody-ie8', get_template_directory_uri() . '/assets/css/ie8.css', array( 'woody-style' ), '20160816' );
  wp_style_add_data( 'woody-ie8', 'conditional', 'lt IE 9' );
  
  // Load the Internet Explorer 7 specific stylesheet.
  wp_enqueue_style( 'woody-ie7', get_template_directory_uri() . '/assets/css/ie7.css', array( 'woody-style' ), '20160816' );
  wp_style_add_data( 'woody-ie7', 'conditional', 'lt IE 8' );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  if ( is_singular() && wp_attachment_is_image() ) {
    wp_enqueue_script( 'woody-keyboard-image-navigation-min', get_template_directory_uri() . '/assets/js/min/keyboard-image-navigation.min.js', array( 'jquery' ), '20160816' );
  }
  
  // Enqueue Scripts
  wp_enqueue_script( 'woody-script', get_template_directory_uri() . '/assets/js/min/custom-functions.min.js', array( 'jquery' ), '20160816', true );
  

  wp_localize_script( 'woody-script', 'screenReaderText', array(
    'expand'   => __( 'expand child menu', 'woody' ),
    'collapse' => __( 'collapse child menu', 'woody' ),
  ) );

}

add_action( 'wp_enqueue_scripts', 'woody_scripts' );

/**
* Adds custom classes to the array of body classes.
*
* @since Woody 1.0
*
* @param array $classes Classes for the body element.
* @return array (Maybe) filtered body classes.
*/
function woody_body_classes( $classes ) {
  // Adds a class of custom-background-image to sites with a custom background image.
  if ( get_background_image() ) {

    $classes[] = 'custom-background-image';

  }

  // Adds a class of group-blog to sites with more than 1 published author.
  if ( is_multi_author() ) {

    $classes[] = 'group-blog';

  }

  // Adds a class of no-sidebar to sites without active sidebar.
  if ( ! is_active_sidebar( 'sidebar-blog', 'sidebar-page', 'sidebar-footer-1', 'sidebar-footer-2', 'sidebar-footer-3', 'sidebar-footer-4', 'topbar-left', 'topbar-right' ) ) {
    
    $classes[] = 'no-sidebar';
  
  }

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    
    $classes[] = 'hfeed';
  
  }

  return $classes;

}

add_filter( 'body_class', 'woody_body_classes' );

/**
* Converts a HEX value to RGB.
*
* @since Woody 1.0
*
* @param string $color The original color, in 3- or 6-digit hexadecimal form.
* @return array Array containing RGB (red, green, and blue) values for the given
*               HEX code, empty array otherwise.
*/
function woody_hex2rgb( $color ) {
$color = trim( $color, '#' );

  if ( strlen( $color ) === 3 ) {
    $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
    $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
    $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) === 6 ) {
    $r = hexdec( substr( $color, 0, 2 ) );
    $g = hexdec( substr( $color, 2, 2 ) );
    $b = hexdec( substr( $color, 4, 2 ) );

  } else {

  return array();

  }

  return array( 'red' => $r, 'green' => $g, 'blue' => $b );

}

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Woody 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function woody_content_image_sizes_attr( $sizes, $size ) {
  $width = $size[0];

  840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

  if ( 'page' === get_post_type() ) {
    840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  } else {
    840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
    600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  }

  return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'woody_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Woody 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function woody_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
  if ( 'post-thumbnail' === $size ) {
    is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
    ! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
  }
  return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'woody_post_thumbnail_sizes_attr', 10 , 3 );

/**
* Modifies tag cloud widget arguments to have all tags in the widget same font size.
*
* @since Woody 1.0
*
* @param array $args Arguments for tag cloud widget.
* @return array A new modified arguments.
*/
function woody_widget_tag_cloud_args( $args ) {

  $args['largest'] = 1;
  $args['smallest'] = 1;
  $args['unit'] = 'em';

  return $args;

}

add_filter( 'widget_tag_cloud_args', 'woody_widget_tag_cloud_args' );