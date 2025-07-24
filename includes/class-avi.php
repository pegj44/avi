<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme main class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi {

	/**
	 * Theme version.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $version = '1.0.0';

	/**
	 * Template directory path.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $template_dir = '';

	/**
	 * Template directory URL.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $template_dir_url = '';

	/**
	 * Stylesheet directory.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $stylesheet_dir = '';

	/**
	 * Stylesheet directory URL.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $stylesheet_dir_url = '';

	/**
	 * Instance of the Avi object.
	 *
	 * @static
	 * @access public
	 * @var null|object
	 */
	public static $instance = null;

	/**
	 * Avi admin init.
	 *
	 * @access public
	 * @var object
	 */
	public $admin_init = '';

	/**
	 * Avi public init.
	 *
	 * @access public
	 * @var object
	 */
	public $public_init = '';

	/**
	 * Avi options init.
	 *
	 * @access public
	 * @var object
	 */
	public $options_init = '';

	/**
	 * Avi option filters init.
	 *
	 * @access public
	 * @var object
	 */
	public $options_filters = '';

	/**
	 * Avi options_functions init.
	 *
	 * @access public
	 * @var object
	 */
	public $options_functions = '';

	/**
	 * Avi template structure init.
	 *
	 * @access public
	 * @var object
	 */
	public $template_structure = '';

	/**
	 * Custom post types init
	 *
	 * @access public
	 * @var object
	 */
	public $post_types = '';

	/**
	 * Custom taxonomies init
	 *
	 * @access public
	 * @var object
	 */
	public $taxonomies = '';

	/**
	 * Woocommerce init.
	 *
	 * @access public
	 * @var object
	 */
	public $woocommerce_init = '';

	/**
	 * Widgets init.
	 *
	 * @access public
	 * @var object
	 */
	public $widgets_init = '';

	/**
	 * Shortcodes init.
	 *
	 * @access public
	 * @var object
	 */
	public $shortcodes_init = '';

	/**
	 * Access the single instance of this class.
	 *
	 * @return Avi
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Avi();
		}
		return self::$instance;
	}

	/**
	 * Class constructor
	 */
	private function __construct() {

		self::$template_dir 	  = get_template_directory();
		self::$template_dir_url   = get_template_directory_uri();
		self::$stylesheet_dir 	  = get_stylesheet_directory();
		self::$stylesheet_dir_url = get_stylesheet_directory_uri();

		// Include classes.
		self::avi_includes('includes/', array(
			'class-avi-setup-admin',
			'class-avi-setup-public',
			'class-avi-nav-walker',
			'class-avi-edit-nav-walker',
			'class-avi-post-types',
			'class-avi-taxonomy',
			'class-avi-options',
			'avi-redux/class-avi-options-functions',
			'avi-redux/class-avi-options-filters',			
			'class-avi-template-structure',
			'class-avi-breadcrumbs',
			'class-avi-comments-walker',
			'class-avi-woocommerce',
			'widgets/class-avi-widgets-loader',
			'shortcodes/class-avi-shortcodes-loader'
		));
		
		/**
		 * Initialize theme basic setup for admin and front-end.
		 */
		$this->admin_init = new Avi_Setup_Admin();
		$this->public_init = new Avi_Setup_Public();			
		$this->taxonomies = new Avi_Taxonomy();
		$this->post_types = new Avi_Post_Types();		

		/**
		 * Initialize avi theme options class.
		 */
		if ( ! class_exists( 'Redux' ) ) {

			$this->options_init = new Avi_Options();
			$this->options_functions = new Avi_Options_Functions();	   
			$this->options_filters = new Avi_Options_Filters();
		}

		/**
		 * Include Advanced Custom Fields plugin.
		 */ 
		if( ! class_exists('acf') ) {
			
			self::avi_includes( 'includes/plugins/', array(
				'acf/acf',
				'acf/avi-fields/metabox',
				'acf/avi-fields/avi-color_picker-rgba',
				'acf/avi-fields/av-acf-button'
			));
		}

		/**
		 * Initialize template structure main class.
		 */
		$this->template_structure = new Avi_Template_Structure();

		/**
		 * Initialize Avi_Woocommerce setup class.
		 */
		if( class_exists('woocommerce') ) {			

			$this->woocommerce_init = new Avi_Woocommerce();
		}

		$this->widgets_init = new Avi_Widgets_Loader();
		$this->shortcodes_init = new Avi_Shortcodes_Loader();
	}

	/**
	 * File includer
   	 *
	 * Sample usage:   	 
   	 * 	$directory = 'includes/myfile' NOTE: myfile is a file prefix if it's not a directory.
   	 * 	$files = 'file' OR array('file1', 'file2') if include multiple files in a directory.
   	 * 	$include_type = 'require_once' by default.
   	 *
   	 * 	avi_includes( string $directory, string|array $files, string $include_type);
   	 *	
	 * @static
	 * @access public
	 * @since 1.0
	 * @param mixed	 
	 */
	public static function avi_includes() {

		// Set array index defaults
		$args = array_replace(array(
			0 => '',
			1 => '',
			2 => 'require_once'
		), func_get_args());

		$separator = ( '' !== $args[1] && '/' !== substr($args[0], -1) )? '-' : '';

		if( is_array($args[1]) ) {
			foreach ($args[1] as $slug) {
				forward_static_call_array( 'Avi::avi_do_' . $args[2], array(self::$template_dir .'/'. $args[0] . $separator . $slug .'.php') );
			}
		} else {
			forward_static_call_array( 'Avi::avi_do_' . $args[2], array(self::$template_dir .'/'. $args[0] . $separator . $args[1] .'.php') );
		}
	}

	/**
	 * Perform php include
	 *
	 * @static
	 * @access private
	 * @since 1.0
	 * @param string
	 */
	private static function avi_do_include($file) {
		include $file;
	}

	/**
	 * Perform php include_once
	 *
	 * @static
	 * @access private
	 * @since 1.0
	 * @param string
	 */
	private static function avi_do_include_once($file) {
		include_once $file;
	}

	/**
	 * Perform php require
	 *
	 * @static
	 * @access private
	 * @since 1.0
	 * @param string
	 */
	private static function avi_do_require($file) {
		require $file;
	}

	/**
	 * Perform php require_once
	 *
	 * @static
	 * @access private
	 * @since 1.0
	 * @param string
	 */
	private static function avi_do_require_once($file) {
		require_once $file;
	}

	public function filter( $param ) {

		return $param;
	}
	
} // end class

$avi = Avi::get_instance();