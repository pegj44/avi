<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme template sidebar class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Template_Sidebar extends Avi_Template_Structure {

	public $count = 0;
	public $sidebar_left = false;
	public $sidebar_right = false;

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		$this->sidebar();

		add_action( 'avi_before_loop', array( $this, 'avi_left_sidebar' ), 10, 0 );
		add_action( 'avi_after_loop',  array( $this, 'avi_right_sidebar' ), 10, 0 );
	}	

	/**
	 * Call sidebar function by window type
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function sidebar() {	

		$window = $this->get_window();		
		$window = ( is_singular() && $window !== 'page' && $window !== 'shop' && !is_avi_woo('product') )? 'blog' : $window;	

		if( !is_callable( array($this, 'sidebar_'. $window ) ) ) {
 			return false;
		}

		call_user_func( array($this, 'sidebar_'. $window ) );
	}

	/**
	 * Set blog and single post sidebar widget
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function sidebar_blog() {

		if( is_home() && $this->option('avi-blog-num-col') === '5' ) { return false; }

		$this->set_sidebar_widget('blog');

		if( is_singular() && !is_page() ) {
			$this->sidebar_left = $this->get_field( 'avi_left_sidebar', $this->sidebar_left );
			$this->sidebar_right = $this->get_field( 'avi_right_sidebar', $this->sidebar_right );
		}
		
	}

	/**
	 * Set archive sidebar widget
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function sidebar_archive() {

		if( $this->option('avi-archive-num-col') === '5' ) { return false; }

		$this->set_sidebar_widget('archive');
	}

	/**
	 * Set page sidebar widget
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function sidebar_page() {

		$this->set_sidebar_widget('page');

		$this->sidebar_left = $this->get_field( 'avi_left_sidebar', $this->sidebar_left );
		$this->sidebar_right = $this->get_field( 'avi_right_sidebar', $this->sidebar_right );
	}

	/**
	 * Set shop and single product sidebar widget
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function sidebar_shop() {

		$this->set_sidebar_widget('shop');

		$this->sidebar_left = $this->get_field( 'avi_left_sidebar', $this->sidebar_left );
		$this->sidebar_right = $this->get_field( 'avi_right_sidebar', $this->sidebar_right );		
	}

	/**
	 * Set sidebar widget value	
	 *
  	 * @access public
	 * @since  1.0 
	 * @param  string
	 * @return void	 
	 */
	public function set_sidebar_widget($window) {

		$positions = array('left', 'right');

		foreach ($positions as $position) {
			if( in_array($this->option('avi-'. $window .'-layout'), array('both_sidebar', $window .'-'. $position .'-widget')) ) {
				$this->count += 1;
				$sidebar_pos = 'sidebar_'. $position;
				$this->$sidebar_pos = $window .'-'. $position .'-widget';
			}
		}
	}

	/**
	 * Render left sidebar
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function avi_left_sidebar() {

		if( $this->sidebar_left ) {
			$this->avi_template( 'sidebar/sidebar-left', array('widget' => $this->sidebar_left) );
		}

		$class = array('postcontent', 'nobottommargin', 'clearfix');

		if( $this->sidebar_left && !$this->sidebar_right ) {
			$class[] = 'col_last';
		}
		if( $this->sidebar_left && $this->sidebar_right ) {
			$class[] = 'bothsidebar';
		}

		if( $this->sidebar_left || $this->sidebar_right ) {
			echo '<div class="'. implode(' ', $class) .'">';	
		}
	}

	/**
	 * Render right sidebar
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function avi_right_sidebar() {

		if( $this->sidebar_left || $this->sidebar_right ) {
			echo '</div>';
		}
		if( $this->sidebar_right ) {
			$this->avi_template( 'sidebar/sidebar-right', array('widget' => $this->sidebar_right) );
		}	
	}

} // end class