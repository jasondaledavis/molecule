<?php
/**
 * Molecule Customizer functionality
 *
 * @package WordPress
 * @subpackage Molecule
 * @since Molecule 2.4.3
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Molecule 1.0
 *
 * @see molecule_header_style()
 */
function molecule_custom_header_and_background() {

	/**
	 * Filter the arguments used when adding 'custom-background' support in Molecule.
	 *
	 * @since Molecule 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background' );
	/**
	 * Filter the arguments used when adding 'custom-header' support in Molecule.
	 *
	 * @since Molecule 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'molecule_custom_header_args', array(
		'width'                  => 1200,
		'height'                 => 280,
		'flex-height'            => true,
		'flex-width'             => true,
		'wp-head-callback'       => 'molecule_header_style',
		'header-selector'        => '.site-title a',
		'header-text'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'molecule_custom_header_and_background' );

if ( ! function_exists( 'molecule_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own molecule_header_style() function to override in a child theme.
 *
 * @since Molecule 1.0
 *
 * @see molecule_custom_header_and_background().
 */
function molecule_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}
	// If the header text has been hidden.
	?>
	<style type="text/css" id="molecule-header-css">
		.site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // molecule_header_style

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Molecule 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function molecule_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'molecule_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'molecule_customize_partial_blogdescription',
		) );
	}

}
add_action( 'customize_register', 'molecule_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Molecule 1.2
 * @see molecule_customize_register()
 *
 * @return void
 */
function molecule_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Molecule 1.2
 * @see molecule_customize_register()
 *
 * @return void
 */
function molecule_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Molecule 1.0
 */
function molecule_customize_preview_js() {
	wp_enqueue_script( 'molecule-customize-preview', get_template_directory_uri() . '/assets/js/min/customize-preview-min.js', array( 'customize-preview' ), '20160816', true );
}
add_action( 'customize_preview_init', 'molecule_customize_preview_js' );

// add_action( "customize_register", "molecule_theme_customize_register" );
// function molecule_theme_customize_register( $wp_customize ) {

 //=============================================================
 // Remove Colors, Background image, and Static front page 
 // option from theme customizer     
 //=============================================================
//  $wp_customize->remove_section("colors");
// }