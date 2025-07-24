<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Custom post types
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Post_types {

	public $post_types = array();

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Add slider post type
		$this->post_types['avi_slide'] = array(
			'label' => __('Slider', 'avi'),
			'labels' => $this->auto_labels('Slide', 'Slides', array(
				'name' => __('Slider', 'alex'),
				'add_new' => __('Add Slide', 'alex'),
			)),
			'supports' => array( 'title' ),
			'show_ui' => true,
			'menu_position' => 5,
			'menu_icon' => 'dashicons-slides',
			'capability_type' => 'page',
			'taxonomies' => array('avi_slider')
		);

		add_action( 'init', array( $this, 'post_type_adder' ) );
	}

	public function post_type_adder() {

		foreach ($this->post_types as $key => $args) {
		
			register_post_type( $key, $args );
			flush_rewrite_rules();
		}
	}

	public function auto_labels($singular, $plural, $override = array()) {

		$labels = array(
			'name' => __($singular, 'avi'),
			'singular_name' => __($plural, 'avi'),
			'add_new' => __('Add New', 'avi'),
			'add_new_item' => __('Add New '. $singular, 'avi'),
			'edit_item' => __('Edit '. $singular, 'avi'),
			'new_item' => __('Add New '. $singular, 'avi'),
			'view_item' => __('View '. $singular, 'avi'),
			'view_items' => __('View '. $plural, 'avi'),
			'search_items' => __('Search '. $plural, 'avi'),
			'not_found' => __('No '. $plural .' found', 'avi'),
			'not_found_in_trash' => __('No '. $plural .' found in Trash', 'avi'),
			'parent_item_colon' => __('Parent '. $singular, 'avi'),
			'all_items' => __('All '. $plural, 'avi'),
			'archives' => __($plural, ' Archives', 'avi'),
			'attributes' => __($singular .' Attributes', 'avi'),
			'insert_into_item' => __('Insert into '. $singular, 'avi'),
			'uploaded_to_this_item' => __('Uploaded to this '. $singular, 'avi'),
			'featured_image' => __('Featured Image', 'avi'),
			'set_featured_image' => __('Set featured image', 'avi'),
			'remove_featured_image' => __('Remove featured image', 'avi'),
			'use_featured_image' => __('Use as featured image', 'avi'),
			'name_admin_bar' => __($singular, 'avi')
		);

		if( !empty($override) ) {
			$labels = array_merge($labels, $override);
		}		

		return $labels;
	}
	
} // end class