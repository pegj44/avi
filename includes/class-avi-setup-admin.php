<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme admin setup class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Setup_Admin {

	/**
	 * The custom navigation fields
	 *
	 * @static
	 * @access private
	 * @since  1.0
	 * @var array
	 */
	private static $nav_items = array(
			'icon' => '_menu_item_icon',
			'subtitle' => '_menu_item_subtitle'
		);

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		// load includes
		$this->includes();

		// initialize basic theme setup, registration and init actions.
		add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
	 	add_action( 'after_setup_theme', array( $this, 'add_image_size' ) );
	 	add_action( 'after_setup_theme', array( $this, 'register_nav_menus' ) );
	 	add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_nav_fields' ) );
	 	add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_nav_fields'), 10, 3 );
	 	add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_walker'), 10, 2 );

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'tgmpa_register', array( $this, 'tgmpa_register' ) );
		add_action( 'vc_before_init', array( $this, 'visual_composer' ) );

		add_filter( 'avi_slider_row_actions', array( $this, 'edit_taxonomy_table_links' ) );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );		
		add_filter( 'manage_edit-avi_slider_columns', array( $this, 'avi_slider_edit_columns') );
	}

	/**
	 * Includes
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	 */
	public function includes() {

		Avi::avi_includes('includes/class-tgm-plugin-activation');
	}

	/**
	 * Enqueue admin scripts
	 *
	 * @access public
	 * @since  1.0
	 * @param  string
	 * @return void	 
	 */
	public function admin_enqueue_scripts( $window ) {

		$screen = get_current_screen();

		if( $screen->post_type === 'avi_slide' ) {
			wp_enqueue_script( 'wp-color-picker-alpha', Avi::$template_dir_url .'/assets/js/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), '1.2.2', true );
			
		}
	}

	/**
	 * Add theme support
	 *
	 * @access public
	 * @since  1.0
	 * @return void	 
	 */
	public function add_theme_support() {

		add_theme_support( 'title-tag' ); // Add title tag to header
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );	// Add post formats
		add_theme_support( 'automatic-feed-links' ); // Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'woocommerce' );	// Add woocommerce support		
		add_theme_support( 'post-thumbnails' ); // Add post thumbnail support
	}

	/**
	 * Add image sizes
	 *
	 * @access public
	 * @since  1.0
	 * @return void	 
	 */
	public function add_image_size() {

		add_image_size( 'thumb-300x300', 300, 300, true );
		add_image_size( 'thumb-400x300', 400, 300, true );
		add_image_size( 'thumb-520x280', 520, 280, true );
		add_image_size( 'thumb-600x450', 600, 450, true );
		add_image_size( 'thumb-860x400', 860, 400, true );
	}

	/**
	 * Theme nav menu adder
	 *
	 * @access public
	 * @since  1.0
	 * @return void	 
	 */
	public function register_nav_menus() {

		register_nav_menus( array( 
			'top_menu' => __( 'Top Menu', 'avi' ),
			'primary' => __( 'Primary Menu', 'avi' ),			
			'split-left' => __( 'Split Menu Left', 'avi' ),	
			'split-right' => __( 'Split Menu Right', 'avi' ),	
			'footer_menu' => __( 'Footer Menu', 'avi' ),			
		));		
	}

	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access public
	 * @since  1.0
	 * @param  string
	 * @return string
	 */
	public function add_custom_nav_fields( $menu_item ) {

		foreach (self::$nav_items as $key => $item) {			
			$menu_item->$key = get_post_meta( $menu_item->ID, $item, true );
		}

	    return $menu_item;
	}

	/**
	 * Save menu custom fields
	 *
	 * @access public
	 * @since  1.0
	 * @param  int
	 * @param  int
	 * @param  array
	 * @return void
 	 */
	public function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

		foreach (self::$nav_items as $item) {

			$key = ltrim(preg_replace('/_/', '-', $item), '-');

		    if ( is_array( $_REQUEST[$key]) && isset($_REQUEST[$key][$menu_item_db_id]) ) {
		        $val = $_REQUEST[$key][$menu_item_db_id];
		        update_post_meta( $menu_item_db_id, $item, $val );
		    }
		}   
	}

	/**
	 * Define new Walker edit
	 *
	 * @access public
	 * @since  1.0 
	 * @param  string
	 * @param  int
	 * @return string
	 */
	function edit_walker( $walker, $menu_id ) {

	    return 'Walker_Nav_Menu_Edit_Custom';
	}

	/**
	 * Register default widgets
	 *
	 * @access public
	 * @since 1.0
	 * @return void
	 */
	public function widgets_init() {

		// store default widget areas.
		$sidebars = array(
			'blog-left-widget'     => array('title' => 'Blog Left',  'desc' => 'Appears on blog left sidebar'),
			'blog-right-widget'    => array('title' => 'Blog Right', 'desc' => 'Appears on blog right sidebar'),
			'archive-left-widget'  => array('title' => 'Archive Left',  'desc' => 'Appears on archive left sidebar'),
			'archive-right-widget' => array('title' => 'Archive Right', 'desc' => 'Appears on archive right sidebar'),
			'page-left-widget'     => array('title' => 'Page Left',  'desc' => 'Appears on page left sidebar'),
			'page-right-widget'    => array('title' => 'Page Right', 'desc' => 'Appears on page right sidebar'),
			'shop-left-widget'     => array('title' => 'Shop Left',  'desc' => 'Appears on shop left sidebar'),
			'shop-right-widget'    => array('title' => 'Shop Right', 'desc' => 'Appears on shop right sidebar'),			
		);
	
		// register default sidebars
		foreach ( $sidebars as $id => $val) {

			register_sidebar( array(
				'name'          => __( $val['title'], 'avi' ),
				'id'            => $id,
				'description'   => __( $val['desc'], 'avi' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>',
			) );
		}	
	}

	/**
	 * TGM_Plugin_Activation
	 *
	 * @access public
	 * @since 1.0
	 * @return void	 
	 */
	public function tgmpa_register() {

		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(

			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'               => 'WPBakery Visual Composer', // The plugin name.
				'slug'               => 'js_composer', // The plugin slug (typically the folder name).
				'source'             => Avi::$template_dir_url . '/includes/plugins/js_composer.zip', // The plugin source.
				'required'           => false, // If false, the plugin is only 'recommended' instead of required.
				'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
				'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
				'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
				'external_url'       => '', // If set, overrides default API URL and points to an external URL.
				'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
			),

			array(
				'name'      => 'Contact Form 7',
				'slug'      => 'contact-form-7',
				'required'  => true,
			),	
		);

		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'avi',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);	

		tgmpa( $plugins, $config );
	}

	/**
	 * Force Visual Composer to initialize as "built into the theme". 
	 * This will hide certain tabs under the Settings->Visual Composer page
	 *
	 * @access public
	 * @since 1.0
	 * @return void	 
	 */
	public function visual_composer() {
	    vc_set_as_theme();
	}

	/**
	 * Remove "Quick Edit" and "View" links from avi_slider taxonomy table row
	 *
	 * @since 1.0
	 */	
	public function edit_taxonomy_table_links( $actions ) {
		
		unset($actions['inline hide-if-no-js']);
		unset($actions['view']);		
		return $actions;
	}

	/**
	 * Updated avi_slider taxonomy columns
	 *
	 * @since 1.0
	 */	
	public function avi_slider_edit_columns( $columns ) {

		unset($columns['description']);
		unset($columns['slug']);

		$columns['name'] = __('Sliders', 'avi');
		$columns['posts'] = __('Slides', 'avi');		

		return $columns;
	}

	/**
	 * Add scripts to admin head
	 *
	 * @since 1.0
	 */	
	public function admin_head() {

		$screen = get_current_screen();

		if( $screen->post_type === 'avi_slide' || $screen->taxonomy === 'avi_slider' ) {

			echo '<style>	
				tr.form-field.term-slug-wrap,
				tr.form-field.term-description-wrap,
				.form-field.term-slug-wrap,
				.form-field.term-description-wrap {
					display: none !important;
				}
				.edit-tags-php #wpbody .wrap:before,
				.term-php #wpbody .wrap:before {
				    content: "";
				    display: block;
				    position: fixed;
				    border: 4px solid #838383;
				    border-radius: 50%;
				    border-top: 4px solid #eaeaea;
				    border-bottom: 4px solid #eaeaea;
				    width: 24px;
				    height: 24px;
				    -webkit-animation: spin 2s linear infinite;
				    animation: spin 2s linear infinite;
				    z-index: 999;
				    top: 45%;
				    left: 50%;
				    box-shadow: inset 0px 0px 1px rgba(0, 0, 0, 0.63), 0px 0px 3px 0px rgba(0, 0, 0, 0.44);
				}
				@-webkit-keyframes spin {
				  0% { -webkit-transform: rotate(0deg); }
				  100% { -webkit-transform: rotate(360deg); }
				}

				@keyframes spin {
				  0% { transform: rotate(0deg); }
				  100% { transform: rotate(360deg); }
				}			

				#wpbody .wrap.avi-load-complete:before {
					content: none !important;
				}		
				p.submit {
					display: block !important;
				}
				select#newavi_slider_parent,
				.form-field.term-parent-wrap {
				    display: none;
				}
				table.avi-acf-widefat {
				    border: 0;
				}				
				table.avi-acf-widefat label {
				    font-weight: normal !important;
				}				
			</style>';

		}		
	}

	/**
	 * Add scripts to admin footer
	 *
	 * @since 1.0
	 */	
	public function admin_footer() {

		$screen = get_current_screen();

		if( $screen->post_type === 'avi_slide' || $screen->taxonomy == 'avi_slider' ) {

			echo '<script type="text/javascript">
				
				jQuery( document ).ajaxStart(function() {
				 	jQuery("#wpbody .wrap").removeClass("avi-load-complete");
				});			
				jQuery(document).ajaxSuccess(function(e) {
					console.log("complete");
					jQuery("#wpbody .wrap").addClass("avi-load-complete");
				});
				console.log("loaded js");
			</script>';		
			}
	}

} // end class