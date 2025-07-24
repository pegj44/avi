<?php

/**
 * Auto load widget classes
 *
 * @package avi
 */

class Avi_Widgets_Loader {
	
	private static $widgets = array();

	public function __construct() {
		
		$this->include_custom_widgets();
		add_action( 'widgets_init', array( $this, 'register_custom_widgets' ) );
	}

	public function include_custom_widgets() {

		$files = array_filter(glob(dirname(__FILE__).'/*.php'), function($file) {
			return false === strpos($file, basename(__FILE__));
		});

		if( !empty($files) ) {

			foreach ($files as $file) {

				require_once dirname(__FILE__) . '/' . basename($file);
				self::$widgets[] = preg_replace('/.php/', '', basename($file));
			}

			return self::$widgets;
		}		
	}	

	function register_custom_widgets() {

		if( !empty(self::$widgets) ) {

			foreach (self::$widgets as $widget) {
				register_widget( $widget );
			}
		}
	}	
}