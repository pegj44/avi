<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Custom taxonomies
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Taxonomy {

	public $taxonomies = array();

	/**
	 * Class constructor
	 */
	public function __construct() {

		// Add taxonomies
		$this->taxonomies['avi_slider'] = array(
			'object_type' => '',
			'args' => array(
				'label' => 'Sliders',
				'labels' => $this->auto_labels('Slider', 'Sliders', array(
					'menu_name' => __('Add/Edit Slider', 'avi'),				
					)),
				'hierarchical' => true,
				'show_admin_column' => true
			),
			'has_archive' => false
		);		

		add_action( 'init', array( $this, 'taxonomy_adder' ) );
		add_action( 'pre_get_posts', array( $this, 'no_taxonomy_archive' ) );
	}

	public function taxonomy_adder() {

		foreach ($this->taxonomies as $key => $args) {
		
			$obj  = $args['object_type'];
			$args = $args['args'];

			register_taxonomy( $key, $obj, $args );			
		}
	}

	public function auto_labels($singular, $plural, $override = array()) {

		$labels = array(
			'name' => _x( $plural, 'Taxonomy General Name', 'avi' ),
			'singular_name' => _x( $singular, 'Taxonomy Singular Name', 'avi' ),
			'menu_name' => __( $plural, 'text_domain' ),
			'all_items' => __( 'All '. $plural, 'avi' ),
			'edit_item' => __( 'Edit '. $singular, 'avi' ),
			'view_item' => __( 'View '. $singular, 'avi' ),
			'update_item' => __( 'Update '. $singular, 'avi' ),
			'add_new_item' => __( 'Add New '. $singular, 'avi' ),
			'new_item_name' => __( 'New '. $singular, 'avi' ),
			'parent_item' => __( 'Parent '. $singular, 'avi' ),
			'parent_item_colon' => __( 'Parent '. $singular .':', 'avi' ),
			'search_items' => __( 'Search '. $plural, 'avi' ),
			'popular_items' => __( 'Popular '. $plural, 'avi' ),
			'separate_items_with_commas' => __( 'Separate '. $plural .' with commas', 'avi' ),
			'add_or_remove_items' => __( 'Add or remove '. $plural, 'avi' ),
			'choose_from_most_used' => __( 'Choose from the most used '. $plural, 'avi' ),
			'not_found' => __( 'No '. $plural .' found.' )
		);

		if( !empty($override) ) {
			$labels = array_merge($labels, $override);
		}		

		return $labels;
	}

	public function no_taxonomy_archive($query) {

        if( !is_tax() ) { return; }

        $obj = get_queried_object();

		foreach ($this->taxonomies as $key => $tax) {			
	        if( $obj->taxonomy === $key && ( isset($tax['has_archive']) && !$tax['has_archive'] ) ){
	            $query->set_404();
	        }
		}

	}

} // end class