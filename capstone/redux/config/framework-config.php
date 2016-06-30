<?php

/**
  ReduxFramework Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_config')) {

    class Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field   set with compiler=>true is changed.

         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'molecule'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'molecule'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'molecule'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'molecule'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'molecule'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'molecule') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'molecule'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon'      => 'el-icon-adjust-alt',
                'title'     => __('General', 'molecule'),
                'heading'   => __('General Theme Settings.', 'molecule'),
                'desc'      => __('<p class="description">Settings for the default theme options.</p>', 'molecule'),
                'fields'    => array(
                    array(
                        'id'             => 'general-logo-margins',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'left'           => 'false',
                        'right'          => 'false',
                        'title'          => __('Logo Margins', 'molecule'),
                        'subtitle'       => __('Adjust top and bottom margins (px) for your logo.', 'molecule'),
                        'default'            => array(
                            'margin-top'     => '0', 
                            'margin-bottom'  => '0',
                            'units'          => 'px', 
                        )
                    ),
                    array(
                        'id'        => 'general-logo-standard',
                        'type'      => 'media', 
                        'url'       => true,
                        'title'     => __( 'Image Logo', 'molecule' ),
                        'subtitle'  => __( 'Upload your own logo to appear in the theme.', 'molecule' ),
                    ),
                    array(
                        'id'        => 'general-text-logo',
                        'type'      => 'switch',
                        'title'     => __('Text Logo', 'molecule'),
                        'subtitle'  => __('Choose if to show a text or image logo.<br /><br /><em><strong>Note:</strong> Choose \'No\' if you chose an image above.</em>', 'molecule'),
                        'default'   => true,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),
                    array(
                        'id'        => 'general-custom-favicon',
                        'type'      => 'media', 
                        'url'       => true,
                        'title'     => __( 'Custom Favicon', 'molecule' ),
                        'subtitle'  => __( 'Upload an image file that will represent your website favicon', 'molecule' ),
                    ),
                    array(
                        'id'        => 'general-apple-touch-icon-iphone',
                        'type'      => 'media', 
                        'url'       => true,
                        'title'     => __( 'Apple Touch Icon (iPhone/iPod)', 'molecule' ),
                        'subtitle'  => __( 'Upload an image file that will represent your Apple touch icon for non-retina iPhone/iPod<br />(Size must be 60x60px). ', 'molecule' ),
                    ),
                    array(
                        'id'        => 'general-apple-touch-icon-ipad',
                        'type'      => 'media', 
                        'url'       => true,
                        'title'     => __( 'Apple Touch Icon (iPad)', 'molecule' ),
                        'subtitle'  => __( 'Upload an image file that will represent your Apple touch icon for non-retina iPad<br />(Size must be 76x76px). ', 'molecule' ),
                    ),
                    array(
                        'id'        => 'general-apple-touch-icon-iphone-retina',
                        'type'      => 'media', 
                        'url'       => true,
                        'title'     => __( 'Apple Touch Icon (iPhone/iPod Retina)', 'molecule' ),
                        'subtitle'  => __( 'Upload an image file that will represent your Apple touch icon for retina iPhone/iPod<br />(Size must be 120x120px). ', 'molecule' ),
                    ),
                    array(
                        'id'        => 'general-apple-touch-icon-ipad-retina',
                        'type'      => 'media', 
                        'url'       => true,
                        'title'     => __( 'Apple Touch Icon (iPad Retina)', 'molecule' ),
                        'subtitle'  => __( 'Upload an image file that will represent your Apple touch icon for retina iPad<br />(Size must be 152x152px). ', 'molecule' ),
                    ),
                    array(
                        'id'        => 'general-portfolio-page',
                        'type'      => 'select',
                        'data'      => 'pages',
                        'title'     => __( 'Portfolio Page Select', 'molecule' ),
                        'subtitle'  => __( 'Please choose the portfolio page you created. This enables you to link back correctly from your single portfolio items.', 'molecule' ),
                    ),
                )
            );
            
            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Header', 'molecule'),
                'heading'   => __('Header Settings', 'molecule'),
                'desc'      => __('<p class="description">Settings for your theme header area.</p>', 'molecule'),
                'fields'    => array(
                    // array(
                    //     'id'        => 'header-slider',
                    //     'type'      => 'text',
                    //     'title'     => __( 'Homepage Header Slider', 'molecule' ),
                    //     'subtitle'  => __( 'Please add your Master Slider shortcode to this field.<br /><br /><em>eg;</em> [slider id="1"]', 'molecule' )
                    // ),
                    // array(
                    //     'id'        => 'overlay-show-hide',
                    //     'type'      => 'switch',
                    //     'title'     => __('Header Overlay Visibility', 'molecule'),
                    //     'subtitle'  => __('Toggle the visibility of the overlay in the headers.', 'molecule'),
                    //     'default'   => false,
                    //     'on'        => 'Show',
                    //     'off'       => 'Hide',
                    // ),
                    // array(
                    //     'id'        => 'separator-show-hide',
                    //     'type'      => 'switch',
                    //     'title'     => __('Header Separator Visibility', 'molecule'),
                    //     'subtitle'  => __('Toggle the visibility of the separator in the headers.', 'molecule'),
                    //     'default'   => true,
                    //     'on'        => 'Show',
                    //     'off'       => 'Hide',
                    // ),
                    array(
                        'id'        => 'header-top-light-background-color',
                        'type'      => 'color',
                        'mode'      => 'background-color',
                        'output'    => array('.header-top'),
                        'title'     => __('Header Top Background Color', 'molecule'),
                        'subtitle'  => __('Pick a background color for the header-top (default: transparent).', 'molecule'),
                        'default'   => '#ffffff',
                        'validate'  => 'color'
                    ),
                    array(
                        'id'        => 'header-top-scroll-background-color',
                        'type'      => 'color',
                        'mode'      => 'background-color',
                        'output'    => array('.header-top-dark'),
                        'title'     => __('Header Top Scroll Background Color', 'molecule'),
                        'subtitle'  => __('Pick a background color for the header-top once you scroll the page (default: #ffffff).', 'molecule'),
                        'default'   => '#ffffff',
                        'validate'  => 'color'
                    ),
                    array(
                        'id'        => 'header-top-mobile-background-color',
                        'type'      => 'color',
                        'mode'      => 'background-color',
                        'output'    => array('.mobile, .mobile .capstonemenu a, .mobile .capstonemenu ul.dropdown, .mobile .capstonemenu ul.dropdown li ul.dropdown, .mobile .capstonemenu ul.dropdown li:hover > a'),
                        'title'     => __('Header Top Mobile Background Color', 'molecule'),
                        'subtitle'  => __('Pick a background color for the header-top on mobile devices (default: #ffffff).', 'molecule'),
                        'default'   => '#ffffff',
                        'validate'  => 'color'
                    ),
                )
            );
            $this->sections[] = array(
                'icon'      => 'el-icon-tint',
                'title'     => __('Colors', 'molecule'),
                'heading'   => __('General Color Settings', 'molecule'),
                'desc'      => __('<p class="description">Settings for your general theme colors.<br /><br /><em><strong>Note:</strong> Please be aware that these will not affect colors you have set via Visual Composer (ie; custom icons). You will need to make those color adjustments there.</em></p>', 'molecule'),
                'fields'    => array(
                    array(
                        'id'        => 'colors-nav-link-normal-color',
                        'type'      => 'color',
                        'mode'      => 'color',
                        'title'     => __('Navigation Link Color (Normal)', 'molecule'), 
                        'subtitle'  => __('Pick a color for your navigation links in normal state (default: #102229).', 'molecule'),
                        'output'    => array( '.capstonemenu a, .capstonemenu a:visited' ),
                        'default'   => '#102229',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'colors-nav-link-hover-color',
                        'type'      => 'color',
                        'mode'      => 'color',
                        'title'     => __('Navigation Link Color (Hover)', 'molecule'), 
                        'subtitle'  => __('Pick a color for your navigation links in hover state (default: #a88c5e).', 'molecule'),
                        'output'    => array( '.capstonemenu a:hover, .capstonemenu li.current a,.capstonemenu a:hover, .capstonemenu li.current-menu-item > a, .capstonemenu li.current_page_item > a, .capstonemenu li.current-menu-ancestor > a, 
.capstonemenu li.current-menu-parent > a, .capstonemenu li.current_page_ancestor > a, .capstonemenu li.current_page_parent > a,.capstonemenu > li > a:before,.capstonemenu > li > a:after,.capstonemenu ul li a:hover, .capstonemenu li li.current-menu-item  a, .capstonemenu li li.current_page_item  a' ),
                        'default'   => '#a88c5e',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'colors-footer-background-color',
                        'type'      => 'color',
                        'mode'      => 'background-color',
                        'title'     => __('Footer Widgets Background Color', 'molecule'), 
                        'subtitle'  => __('Pick a background color for your footer widget area (default: #f6f1eb).', 'molecule'),
                        'output'    => array( '.footer-global' ),
                        'default'   => '#f6f1eb',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'colors-footer-headings-color',
                        'type'      => 'color',
                        'mode'      => 'color',
                        'title'     => __('Footer Headings Color', 'molecule'), 
                        'subtitle'  => __('Pick a color for your footer (default: #ffffff).', 'molecule'),
                        'output'    => array( '.footer-global a, .footer-global p' ),
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'colors-text-logo-color',
                        'type'      => 'color',
                        'mode'      => 'color',
                        'title'     => __('Text Logo Color', 'molecule'), 
                        'subtitle'  => __('Pick a color for your text logo (default: #102229).', 'molecule'),
                        'output'    => array( '.logo h1 a' ),
                        'default'   => '#102229',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'colors-social-icons-color',
                        'type'      => 'color',
                        'mode'      => 'color',
                        'title'     => __('Social Icons Color (Footer)', 'molecule'), 
                        'subtitle'  => __('Pick a color for the social icons that appear in the header and footer (default: #102229).', 'molecule'),
                        'output'    => array( '.footer-global .social-icons li a .fa' ),
                        'default'   => '#102229',
                        'validate'  => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-font',
                'title'     => __('Typography', 'molecule'),
                'heading'   => __('Typography Settings', 'molecule'),
                'desc'      => __('<p class="description">Settings for your general typography</p>', 'molecule'),
                'fields'    => array(
                    array(
                        'id'          => 'typography-body-font',
                        'type'        => 'typography', 
                        'title'       => __('Body Font', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('body'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for the body text<br /><br /><em><strong>Note:</strong> Please be aware that if you have set a color for a text block via Visual Composer on certain pages then you will need to adjust them there.</em>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                        'default'     => array(
                            'font-size'  => '16px',
                            'text-align'  => 'left',
                            'line-height'  => '26px',
                            'font-weight'  => '300', 
                            'color'  => '#102229',
                            'font-family' => 'Open Sans', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'typography-h1-headings-font',
                        'type'        => 'typography', 
                        'title'       => __('h1 Headings Font', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('h1, .post-title, .post-excerpt h1, .project-title'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for your headings<br /><br /><em><strong>Note:</strong> Please be aware that if you have set headings via Visual Composer on certain pages then you will need to adjust them there.<br />These heading settings are for pages (ie; single portfolio, single post etc..) which are not controlled by Visual Composer.</em></p>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                        'default'     => array(
                            'font-size'  => '72px',
                            'text-align'  => 'left',
                            'line-height'  => '68px',
                            'font-weight'  => '400', 
                            'color'  => '#102229',
                            'font-family' => 'Playfair Display', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'typography-h2-headings-font',
                        'type'        => 'typography', 
                        'title'       => __('h2 Headings Font', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('h2'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for your headings<br /><br /><em><strong>Note:</strong> Please be aware that if you have set headings via Visual Composer on certain pages then you will need to adjust them there.<br />These heading settings are for pages (ie; single portfolio, single post etc..) which are not controlled by Visual Composer.</em></p>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                        'default'     => array(
                            'font-size'  => '60px',
                            'text-align'  => 'left',
                            'line-height'  => '66px',
                            'font-weight'  => '400', 
                            'color'  => '#102229',
                            'font-family' => 'Playfair Display', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'typography-h3-headings-font',
                        'type'        => 'typography', 
                        'title'       => __('h3 Headings Fonts', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('h3,#respond h3'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for your headings<br /><br /><em><strong>Note:</strong> Please be aware that if you have set headings via Visual Composer on certain pages then you will need to adjust them there.<br />These heading settings are for pages (ie; single portfolio, single post etc..) which are not controlled by Visual Composer.</em></p>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                        'default'     => array(
                            'font-size'  => '36px',
                            'text-align'  => 'left',
                            'line-height'  => '36px',
                            'font-weight'  => '400', 
                            'color'  => '#102229',
                            'font-family' => 'Playfair Display', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'typography-h4-headings-font',
                        'type'        => 'typography', 
                        'title'       => __('h4 Headings Font', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('h4'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for your headings<br /><br /><em><strong>Note:</strong> Please be aware that if you have set headings via Visual Composer on certain pages then you will need to adjust them there.<br />These heading settings are for pages (ie; single portfolio, single post etc..) which are not controlled by Visual Composer.</em></p>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                        'default'     => array(
                            'font-size'  => '34px',
                            'text-align'  => 'left',
                            'line-height'  => '36px',
                            'font-weight'  => '400', 
                            'color'  => '#102229',
                            'font-family' => 'Open Sans', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'typography-h56-headings-font',
                        'type'        => 'typography', 
                        'title'       => __('h5,h6 Headings Font', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('h5,h6'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for your headings<br /><br /><em><strong>Note:</strong> Please be aware that if you have set headings via Visual Composer on certain pages then you will need to adjust them there.<br />These heading settings are for pages (ie; single portfolio, single post etc..) which are not controlled by Visual Composer.</em></p>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                        'default'     => array(
                            'font-size'  => '24px',
                            'text-align'  => 'left',
                            'line-height'  => '26px',
                            'font-weight'  => '400', 
                            'color'  => '#102229',
                            'font-family' => 'Open Sans', 
                            'google'      => true
                        ),
                    ),
                    array(
                        'id'          => 'typography-custom-heading-font',
                        'type'        => 'typography', 
                        'title'       => __('Custom Heading Font', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('.page-title'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for the heading on your custom header images.</p>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                            'default'     => array(
                                'font-size'  => '72px',
                                'text-align'  => 'center',
                                'line-height'  => '55px',
                                'font-weight'  => '700', 
                                'color'  => '#ffffff',
                                'font-family' => 'Playfair Display', 
                                'google'      => true
                            ),
                        ),
                    array(
                        'id'          => 'typography-custom-subtitle-font',
                        'type'        => 'typography', 
                        'title'       => __('Custom Subtitle Font', 'molecule'),
                        'google'      => true, 
                        'font-backup' => false,
                        'subsets'         => false,
                        'font-size'       => true,
                        'font-weight'     => true,
                        'font-style'      => false,
                        'line-height'      => true,
                        'text-align'      => true,
                        'color'      => true,
                        'output'      => array('.page-subtitle'),
                        'units'       => 'px',
                        'subtitle'    => __('Specify the font properties for the subtitle on your custom header images.</p>', 'molecule'),
                        'preview'     => array(
                            'always_display'    => true,
                            'font-size'         => '33px',
                        ),
                            'default'     => array(
                                'font-size'  => '34px',
                                'text-align'  => 'center',
                                'line-height'  => '36px',
                                'font-weight'  => '300', 
                                'color'  => '#ffffff',
                                'font-family' => 'Open Sans', 
                                'google'      => true
                            ),
                        ),
                )
            );
            
            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Footer', 'molecule'),
                'heading'   => __('Footer Settings', 'molecule'),
                'desc'      => __('<p class="description">Settings for your theme footer area.</p>', 'molecule'),
                'fields'    => array(
                    array(
                        'id'        => 'footer-copyright',
                        'type'      => 'text',
                        'title'     => __( 'Footer Copyright Text', 'molecule' ),
                        'subtitle'  => __( 'Please enter the text to appear at the bottom of your Footer<br />(eg; All rights reserved.)', 'molecule' ),
                        'default'   => 'All rights reserved.',
                    ),
                )
            );
            
            $this->sections[] = array(
                'icon' => 'el-icon-group',
                'title' => __( 'Social', 'molecule' ),
                'heading'   => __('Social Profiles', 'molecule'),
                'desc'      => __('<p class="description">Add your company social profiles.</p>', 'molecule'),
                'fields' => array(
                    array(
                        'id'        => 'social-twitter',
                        'type'      => 'text',
                        'title'     => __( 'Twitter', 'molecule' ),
                        'subtitle'  => __( 'Enter your Twitter Profile URL (ie; https://twitter.com/yourprofile)', 'molecule' ),
                        'default'   => 'https://twitter.com/weareelement502',
                    ),
                    array(
                        'id'        => 'social-facebook',
                        'type'      => 'text',
                        'title'     => __( 'Facebook', 'molecule' ),
                        'subtitle'  => __( 'Enter your Facebook Profile URL (ie; https://facebook.com/yourpagename)', 'molecule' ),
                        'default'   => 'https://facebook.com/element502',
                    ),
                    array(
                        'id'        => 'social-linkedin',
                        'type'      => 'text',
                        'title'     => __( 'Linkedin', 'molecule' ),
                        'subtitle'  => __( 'Enter your Linkedin Profile URL (ie; https://www.linkedin.com/company/your-profile)', 'molecule' ),
                        'default'   => 'https://www.linkedin.com/company/element-502',
                    ),
                    array(
                        'id'        => 'social-googleplus',
                        'type'      => 'text',
                        'title'     => __( 'Google +', 'molecule' ),
                        'subtitle'  => __( 'Enter your Google + Profile URL (ie; https://plus.google.com/+element502)', 'molecule' ),
                    ),
                    array(
                        'id'        => 'social-instagram',
                        'type'      => 'text',
                        'title'     => __( 'Instagram', 'molecule' ),
                        'subtitle'  => __( 'Enter your Instagram Profile URL (ie; https://instagram.com/weareelement502)', 'molecule' ),
                    ),
                    array(
                        'id'        => 'social-youtube',
                        'type'      => 'text',
                        'title'     => __( 'YouTube', 'molecule' ),
                        'subtitle'  => __( 'Enter your YouTube Profile URL (ie; youtube.com/c/Element502Louisville)', 'molecule' ),
                    ),
                )
            );
            
            $this->sections[] = array(
                'icon'      => 'el-icon-css',
                'title'     => __('Custom CSS', 'molecule'),
                'heading'   => __('Custom CSS', 'molecule'),
                'desc'      => __('<p class="description">Add custom CSS to your theme.</p>', 'molecule'),
                'fields'    => array(
                    array(
                        'id'        =>'custom-css',
                        'type'      => 'textarea',
                        'title'     => __( 'Custom CSS', 'molecule' ), 
                        'subtitle'  => __( 'This CSS will be appended to the primary stylesheet. Ideal for custom stylings that you do not want overwritten by updates.<br><br><strong><em>Note:</strong> If a style does not seem to be taking effect, you may need to add <strong>!important</strong> to the end.</em><br><br>ie;<br><br><strong>.my-heading {<br>color: blue!important;<br>}</strong>', 'molecule' ),
                        'rows' => '15',
                    ),
                )
            );
            
            $this->sections[] = array(
                'icon'      => 'el-icon-graph',
                'title'     => __('Google Analytics', 'molecule'),
                'heading'   => __('Google Analytics', 'molecule'),
                'desc'      => __('<p class="description">Add analytics to your theme.</p>', 'molecule'),
                'fields'    => array(
                    array(
                        'id'        => 'google-tracking-code',
                        'type'      => 'textarea',
                        'title'     => __( 'Add your tracking code', 'molecule' ), 
                        'subtitle'  => __( 'Paste your Google Analytics tracking code here (Remember you need to paste all the Javascript code, not just your ID). This will be added into the footer of your theme.<br /><br />Do not have Google Analytics? Unsure what to paste in this box? Visit this <a href="http://www.google.com/analytics" target="_blank">link</a> to find out more.', 'molecule' ),
                        'rows'      => '15',
                    ),
                )
            );
            
            $this->sections[] = array(
                'title'     => __('Import / Export', 'molecule'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'molecule'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );        

            $this->sections[] = array(
                'icon'      => 'el-icon-book',
                'title'     => __('Theme Information', 'molecule'),
                'desc'      => __('<p class="description">Information about your installed theme.</p>', 'molecule'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'molecule'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'molecule'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'molecule')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'molecule'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'molecule')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'molecule');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'capstone_molecule',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('ELEMENT 502', 'molecule'),
                'page_title'        => __('Molecule Options', 'molecule'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyDxoN0FzagOTdcHDuCnJzjkkDGPoVVeP0k', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://element502.com',
                'title' => 'Visit our site',
                'icon'  => 'el-icon-globe'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://twitter.com/weareelement502',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Welcome to the Theme Options panel.</p>', 'molecule'), $v);
            }

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
