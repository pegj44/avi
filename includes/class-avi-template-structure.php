<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme template structure main class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Template_Structure {

	/**
	 * Avi header template init.
	 *
	 * @static
	 * @access public
	 * @var object
	 */
	public $header = '';	

	/**
	 * Avi content template init.
	 *
	 * @static	 
	 * @access public
	 * @var object
	 */
	public $content = '';	

	/**
	 * Avi sidebar template init.
	 *
	 * @static	
	 * @access public
	 * @var object
	 */
	public $sidebar = '';	

	/**
	 * Avi footer template init.
	 *
	 * @static	
	 * @access public
	 * @var object
	 */
	public $footer = '';

	/**
	 * Theme option values container.
	 *
	 * @static
	 * @access public
	 * @var array
	 */
	public static $option = array();

	/**
	 * Current window.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $window = '';

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		if( !is_admin() ) {
			add_action( 'wp', array($this, 'template_init') );	
		}		
	}

	/**
	 * Initialize template structures
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function template_init() {		

		self::$option = Avi_Options::$option_arr;

		$this->set_window_option_key();

		Avi::avi_includes('includes/template-tags');
		
		// Include template classes
		Avi::avi_includes('includes/class-avi-template', array(
			'header', 
			'content',
			'sidebar',
			'footer'
		));

		// Initialize template modules class.
		$this->header  = new Avi_Template_Header();
		$this->sidebar = new Avi_Template_Sidebar();
		$this->content = new Avi_Template_Content();		
		$this->footer  = new Avi_Template_Footer();		
	}

	/**
	 * Get theme option values.
	 *
	 * @access public
	 * @since  1.0 
	 * @param  string
	 * @return array | string 	Return all options array if no option key provided,
	 *							else return option value
	 */
	public function option( $index = '' ) {		

		if( '' !== $index ) {
			if( isset(self::$option->$index) ) {
				return self::$option->$index;
			} else {
				return false;
			}			
		}
		return self::$option;
	}

	/**
	 * Set current window.
	 *
	 * @access public
	 * @since  1.0 
	 * @return void
	 */
	public function set_window_option_key() {

		global $wp_query;

		$window = array(
			'blog' => ( $wp_query->is_home ),
			'archive' => ( ($wp_query->is_archive && !$wp_query->is_home) || $wp_query->is_search ),
			'single' => $wp_query->is_single,
			'page' => ( $wp_query->is_page || $wp_query->is_404),
			'shop' => ( get_query_var('post_type') === 'product' )
		);		

		$window = array_keys(array_filter( $window ));

		if( !empty($window) ) {

			self::$window = array_pop($window);
		}
	}

	/**
	 * Get current window.
	 *
	 * @access public
	 * @since  1.0 
	 * @return string
	 */
	public function get_window() {

		$window = apply_filters('avi_window', self::$window);

		return $window;
	}

	/**
	 * Get option value depending on current window.
	 *
	 * @access public
	 * @since  1.0 
	 * @param  string
	 * @param  array
	 * @param  bool
	 * @return string
	 */
	public function get_window_option( $key, $options = array(), $single_option = true) {		

		if( !empty($options) ) {			
			$options = (array) $options;
			if( empty($options) || !isset($options[$this->get_window()]) ) { return false; }
		} else {

			$options = $this->option($key);
			$options = (array) $options;
		}

		$window = $this->get_window();
		$field  = $this->option($key);

		if( $single_option && is_singular() ) {
			
			if( isset($field->$window) ) {
				return $this->get_field($key, $this->option($key)->$window);
			}
			return false;
			
		} else {

			if( isset($field->$window) ) {
				return $this->option($key)->$window;
			}
			return false;			
		}

	}

	/**
	 * Get field value
	 *
	 * @access public
	 * @since  1.0 
	 * @param  string
	 * @return bool | string 	Return false if field id does not exist OR default value if provided.
	 */
	public function get_field( $id, $default = false ) {

		global $post;

		if( !is_singular() ) { return $default; }

		$field = get_field( $id, $post->ID );

		if( $field === false || $field === 'default' || $field === 'Default' || $field === '' ) {
			return $default;
		} elseif ( $field === 'disable' || $field === 'Disable' ) {
			return false;
		} elseif( $field === 'Enable' || $field === 'enable' ) {
			return true;
		} else {
			return $field;
		}
	}

	/**
	 * Template loader
	 *
	 * @access public
	 * @since  1.0 
	 * @param  array
	 * @return void
	 */
	public function avi_template() {

		$param = func_get_args();
		$path  = locate_template('templates/' . $param[0] . '.php');

		if( isset($param[1]) && !empty($param[1]) ) { extract($param[1]);	}
		if (file_exists($path)) { include($path); }
	}

	/**
	 * Check if field has value
	 *
	 * @access public
	 * @since 1.0
	 * @param  string
	 * @return bool
	 */
	public function is_true( $val ) {

		if( is_array($val) ) {
			if( !empty($val) ) { return true; }
			return false;
		}

		if( !$val || trim($val) === '' ) {
			return false;
		}
		return true;
	}

	// public function add_filters( $filters ) {

	// 	foreach ($filters as $filter) {
	// 		add_filter( $filter, array( $this, 'filter' ), 0, 1 );
	// 	}
	// }

	// public function filter( $param ) {

	// 	return $param;
	// }

} // end class