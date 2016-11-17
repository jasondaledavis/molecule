<?php
/**
 * Molecule functions and definitions
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
 * @subpackage Molecule
 * @since Molecule 1.0
 */
 
//================================================================================//
// Register the themes custom functions and supporting files/directories
//================================================================================//
require get_template_directory() . '/inc/theme-function.php';
/**
 * Molecule only works in WordPress 4.4 or later.
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

if ( ! function_exists( 'molecule_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own molecule_setup() function to override in a child theme.
 *
 * @since Molecule 1.0
 */
function molecule_setup() {
/*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Molecule, use a find and replace
     * to change 'molecule' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'molecule' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );


    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    add_theme_support( 'custom-logo', array(
      'height'      => 800,
      'width'       => 1200,
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
    add_image_size( 'post-thumbnail', 1200, 360, true ); // Large Post Thumbnail (appears on single post and archive pages)
    add_image_size( 'header-image-full', 2000, 800, true); // Page Header Image

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'molecule' ),
      // 'social'  => __( 'Social Links Menu', 'molecule' ),
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
   * Enable support for Post Formats.
   *
   * See: https://codex.wordpress.org/Post_Formats
   */
    add_theme_support( 'post-formats', array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
      'gallery',
      'status',
      'audio',
      'chat',
    ) );

    /*
    * This theme styles the visual editor to resemble the theme style,
    * specifically font, colors, icons, and column width.
    */
    add_editor_style( array( 'assets/css/editor.css', molecule_fonts_url() ) );

    // Indicate widget sidebars can use selective refresh in the Customizer.
    add_theme_support( 'customize-selective-refresh-widgets' );

}
endif; // molecule_setup

add_action( 'after_setup_theme', 'molecule_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Molecule 1.0
 */
function molecule_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'molecule_content_width', 1200 );
}
add_action( 'after_setup_theme', 'molecule_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Molecule 1.0
 */
function molecule_widgets_init() {

      register_sidebar( array(
        'name' => 'Blog Sidebar',
        'id' => 'sidebar-blog',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      ) );

      register_sidebar( array(
        'name' => 'Page Sidebar',
        'id' => 'sidebar-page',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      ) );

      register_sidebar( array(
        'name' => 'Footer Sidebar 1',
        'id' => 'sidebar-footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      ) );

      register_sidebar( array(
        'name' => 'Footer Sidebar 2',
        'id' => 'sidebar-footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      ) );

      register_sidebar( array(
        'name' => 'Footer Sidebar 3',
        'id' => 'sidebar-footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      ) );

      register_sidebar( array(
        'name' => 'Footer Sidebar 4',
        'id' => 'sidebar-footer-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      ) );

      if ( class_exists( 'WooCommerce' ) ) {
                         
        register_sidebar( array(
          'name' => 'Shop Sidebar',
          'id'   => 'shop-sidebar',
          'before_widget' => '<div id="%1$s" class="widget %2$s">',
          'after_widget'  => '</div>',
          'before_title' => '<h4 class="widget-title">',
          'after_title' => '</h4>',
        ) );
 
      } //end woo if

}

add_action( 'widgets_init', 'molecule_widgets_init' );

if ( ! function_exists( 'molecule_fonts_url' ) ) :
/**
 * Register Google fonts for Molecule.
 *
 * Create your own molecule_fonts_url() function to override in a child theme.
 *
 * @since Molecule 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function molecule_fonts_url() {
  $fonts_url = '';
  $fonts     = array();
  $subsets   = 'latin,latin-ext';

  /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
  if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'molecule' ) ) {
    $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
  }

  /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
  if ( 'off' !== _x( 'on', 'Playfair+Display font: on or off', 'molecule' ) ) {
    $fonts[] = 'Playfair+Display:400,700';
  }

  /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
  if ( 'off' !== _x( 'on', 'Abril+Fatface font: on or off', 'molecule' ) ) {
    $fonts[] = 'Abril+Fatface:400';
  }

  if ( $fonts ) {
    $fonts_url = add_query_arg( array(
      'family' => urlencode( implode( '|', $fonts ) ),
      'subset' => urlencode( $subsets ),
    ), 'https://fonts.googleapis.com/css' );
  }

  return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Molecule 1.0
 */
function molecule_javascript_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'molecule_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Molecule 1.0
 */

function molecule_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'molecule-fonts', molecule_fonts_url(), array(), null );

    // Enqueue Scripts
      wp_enqueue_script( 'custom-js', get_template_directory_uri() .'/assets/js/min/custom.min.js', array('jquery'), false, true );
      wp_enqueue_script( 'fitvids-min-js', get_template_directory_uri() .'/assets/js/min/jquery.fitvids.min.js', array('jquery'), false, true );

      // Load the html5 shiv.
      wp_enqueue_script( 'molecule-html5-min', get_template_directory_uri() . '/assets/js/min/html5.min.js', array(), '3.7.3' );
      wp_script_add_data( 'molecule-html5-min', 'conditional', 'lt IE 9' );

      wp_enqueue_script( 'molecule-skip-link-focus-fix-min', get_template_directory_uri() . '/assets/js/min/skip-link-focus-fix.min.js', array(), '20160816', true );

      if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
      }

      if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'molecule-keyboard-image-navigation-min', get_template_directory_uri() . '/js/min/keyboard-image-navigation.min.js', array( 'jquery' ), '20160816' );
      }

      wp_enqueue_script( 'molecule-script', get_template_directory_uri() . '/assets/js/min/functions.min.js', array( 'jquery' ), '20160816', true );

      wp_localize_script( 'molecule-script', 'screenReaderText', array(
        'expand'   => __( 'expand child menu', 'molecule' ),
        'collapse' => __( 'collapse child menu', 'molecule' ),
      ) );
     
    // Enqueue Styles (Global)
      wp_enqueue_style( 'molecule-style', get_stylesheet_uri() );

    // Add Genericons, used in the main stylesheet.
      wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
      
    //Custom WooCommerce Styles
      if (class_exists( 'WooCommerce') ) {
        wp_enqueue_style( 'woo-styles', get_template_directory_uri() . '/assets/css/molecule-woo.css' );
      }

}
    
add_action( 'wp_enqueue_scripts', 'molecule_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Molecule 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function molecule_body_classes( $classes ) {
  // Adds a class of custom-background-image to sites with a custom background image.
  if ( get_background_image() ) {
    $classes[] = 'custom-background-image';
  }

  // Adds a class of group-blog to sites with more than 1 published author.
  if ( is_multi_author() ) {
    $classes[] = 'group-blog';
  }

  // Adds a class of no-sidebar to sites without active sidebar.
  if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
    $classes[] = 'no-sidebar';
  }

  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'molecule_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Molecule 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function molecule_hex2rgb( $color ) {
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
 * @since Molecule 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function molecule_content_image_sizes_attr( $sizes, $size ) {
  $width = $size[0];

  1200 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 1200px';

  if ( 'page' === get_post_type() ) {
    1200 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  } else {
    1200 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
    1200 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
  }

  return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'molecule_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Molecule 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function molecule_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
  if ( 'post-thumbnail' === $size ) {
    is_active_sidebar( 'sidebar-blog' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
    ! is_active_sidebar( 'sidebar-blog' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
  }
  return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'molecule_post_thumbnail_sizes_attr', 10 , 3 );


/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Molecule 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function molecule_widget_tag_cloud_args( $args ) {
    $args['largest'] = 1;
    $args['smallest'] = 1;
    $args['unit'] = 'em';
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'molecule_widget_tag_cloud_args' );