<?php

/**
 * Auto load shortcodes
 *
 * @package avi
 */

class Avi_Shortcodes_Loader {
	
	private static $widgets = array();

	public function __construct() {
		
		$this->include_custom_shortcodes();

		if( function_exists('vc_add_shortcode_param') ) {
			vc_add_shortcode_param( 'number', array( $this, 'avi_vc_number_field_type' ) );
			add_action( 'vc_enqueue_font_icon_element', array( $this, 'enqueue_font_icons' ) );
		}
		
	}

	public function include_custom_shortcodes() {

		$files = array_filter(glob(dirname(__FILE__).'/*.php'), function($file) {
			return false === strpos($file, basename(__FILE__));
		});
		
		foreach ($files as $file) {
			require_once dirname(__FILE__) . '/' . basename($file);
		}
	}

	public function enqueue_font_icons( $font ) {

		switch ( $font ) {
			case 'fontawesome':
				wp_enqueue_style( 'font-awesome' );
				break;
			case 'openiconic':
				wp_enqueue_style( 'vc_openiconic' );
				break;
			case 'typicons':
				wp_enqueue_style( 'vc_typicons' );
				break;
			case 'entypo':
				wp_enqueue_style( 'vc_entypo' );
				break;
			case 'linecons':
				wp_enqueue_style( 'vc_linecons' );
				break;
			case 'monosocial':
				wp_enqueue_style( 'vc_monosocialiconsfont' );
				break;
			default:
				//
		}
	}

	/**
	 * Add number field type
	 */
	public function avi_vc_number_field_type( $settings, $value ) {
	   return '<div class="my_param_block">'
	             .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
	             esc_attr( $settings['param_name'] ) . ' ' .
	             esc_attr( $settings['type'] ) . '_field" type="number" value="' . esc_attr( $value ) . '" />' .
	             '</div>'; // This is html markup that will be outputted in content elements edit form
	}
	

} // end class