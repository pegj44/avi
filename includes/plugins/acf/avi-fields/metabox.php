<?php

/**
 * Metaboxes
 *
 * This file insert metaboxes to post/page from ACF exported fields
 *
 * Class Name: Avi_Metaboxes
 * @package avi
 * @version 1.0
 */

class Avi_Metaboxes {

	function __construct() {
	           	  
	    add_action( 'init', array( $this, 'metaboxes' ) );
	}

	/*===========================================================
							    Metaboxes
	  ===========================================================*/

    /**
    * Exported custom fields php from ACF
    *
    * @return void
    */
	public function metaboxes() {
	
		/* 
		 * Page Settings
		 */

		if(function_exists("register_field_group"))
		{
			register_field_group(array (
				'id' => 'acf_page-settings',
				'title' => 'Page Settings',
				'fields' => array (
					array (
						'key' => 'field_594e34fa98796',
						'label' => 'Slider',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_594e352198797',
						'label' => 'Select Slider',
						'name' => 'avi_slider',
						'type' => 'taxonomy',
						'taxonomy' => 'avi_slider',
						'field_type' => 'select',
						'allow_null' => 1,
						'load_save_terms' => 1,
						'return_format' => 'id',
						'multiple' => 0,
					),
					array (
						'key' => 'field_594e35d798798',
						'label' => 'Slider Position',
						'name' => 'avi_slider_position',
						'type' => 'select',
						'choices' => array (
							'after' => 'After Header',
							'before' => 'Before Header',
						),
						'default_value' => 'after',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_594e360498799',
						'label' => 'Transparent Header',
						'name' => 'avi_transparent_header',
						'type' => 'true_false',
						'instructions' => 'Make site header transparent on this post/page.',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_59436ef076f35',
						'label' => 'Page Title Bar',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_59436f1f76f36',
						'label' => 'Page Title Bar',
						'name' => 'avi-page-header',
						'type' => 'select',
						'choices' => array (
							'default' => 'Default',
							'enable' => 'Show All',
							'disable' => 'Hide all',
							'content' => 'Show Contents only',
						),
						'default_value' => 'default',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_594371a376f37',
						'label' => 'Subheading',
						'name' => 'avi-page-subheading',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'disable',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_594372b276f3a',
						'label' => 'Dark Theme',
						'name' => 'avi_page_header_dark',
						'type' => 'true_false',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'disable',
								),
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'content',
								),
							),
							'allorany' => 'all',
						),
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_5943723076f38',
						'label' => 'Background Color',
						'name' => 'avi_page_bg_color',
						'type' => 'color_picker',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'disable',
								),
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'content',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
					),
					array (
						'key' => 'field_5943725e76f39',
						'label' => 'Background Image',
						'name' => 'avi_page_header_bg_img',
						'type' => 'image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'disable',
								),
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'content',
								),
							),
							'allorany' => 'all',
						),
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_5943736e76f3b',
						'label' => 'Background Size',
						'name' => 'avi_page_header_bg_size',
						'type' => 'select',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'disable',
								),
								array (
									'field' => 'field_59436f1f76f36',
									'operator' => '!=',
									'value' => 'content',
								),
							),
							'allorany' => 'all',
						),
						'choices' => array (
							'centerslashcover_no-repeat' => 'Cover',
							'centerslashcontain_no-repeat' => 'Contain',
							'no-repeat' => 'No Repeat',
							'repeat' => 'Repeat',
						),
						'default_value' => 'centerslashcover_no-repeat',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_594394e88c375',
						'label' => 'Sidebar',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_594395058c376',
						'label' => 'Left Sidebar',
						'name' => 'avi_left_sidebar',
						'type' => 'select',
						'choices' => $this->get_sidebars(),
						'default_value' => 'default',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5943952d8c377',
						'label' => 'Right Sidebar',
						'name' => 'avi_right_sidebar',
						'type' => 'select',
						'choices' => $this->get_sidebars(),
						'default_value' => 'default',
						'allow_null' => 0,
						'multiple' => 0,
					),
				),
				'location' => $this->get_public_post_types(),
				'options' => array (
					'position' => 'normal',
					'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));

			register_field_group(array (
				'id' => 'acf_slide-settings',
				'title' => 'Slide Settings',
				'fields' => array (
					array (
						'key' => 'field_594768a6deec6',
						'label' => 'General',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_5946f25c6675e',
						'label' => 'Slide Type',
						'name' => 'avi_slide_type',
						'type' => 'select',
						'choices' => array (
							'image' => 'Image',
							'video' => 'Video',
							'video_url' => 'Video URL',
						),
						'default_value' => 'image',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5946e4f23eed6',
						'label' => 'Image',
						'name' => 'avi_slide_image',
						'type' => 'image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946f25c6675e',
									'operator' => '==',
									'value' => 'image',
								),
							),
							'allorany' => 'all',
						),
						'save_format' => 'object',
						'preview_size' => 'full',
						'library' => 'all',
					),
					array (
						'key' => 'field_5946f2ab6675f',
						'label' => 'Video',
						'name' => 'avi_slide_video',
						'type' => 'file',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946f25c6675e',
									'operator' => '==',
									'value' => 'video',
								),
							),
							'allorany' => 'all',
						),
						'save_format' => 'url',
						'library' => 'all',
					),
					array (
						'key' => 'field_5946f2f1dc1a3',
						'label' => 'Video URL',
						'name' => 'avi_slide_video_url',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946f25c6675e',
									'operator' => '==',
									'value' => 'video_url',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5946f3a04eed9',
						'label' => 'Color Overlay',
						'name' => 'avi_slide_color_overlay',
						'type' => 'avi_color_picker',
						'default_value' => '',
					),
					array (
						'key' => 'field_5946e61d3eedb',
						'label' => 'Grid Overlay',
						'name' => 'avi_slide_img_overlay',
						'type' => 'true_false',
						'instructions' => 'Check to add grid image overlay to this slide.',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_594e705b37a84',
						'label' => 'Dark Content Text',
						'name' => 'avi_slide_dark',
						'type' => 'true_false',
						'instructions' => 'Check if slide content needs to be dark.',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_5946e5cb3eed9',
						'label' => 'Content',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_5946e6af2df19',
						'label' => 'Custom HTML content',
						'name' => 'avi_slide_custom_html',
						'type' => 'true_false',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_5946e79df7063',
						'label' => 'Content Text Position',
						'name' => 'avi_slide_content_position',
						'type' => 'select',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946e6af2df19',
									'operator' => '!=',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'choices' => array (
							'left' => 'Left',
							'center' => 'Center',
							'right' => 'Right',
						),
						'default_value' => 'center',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5946e5213eed7',
						'label' => 'Heading Text',
						'name' => 'avi_slide_heading_text',
						'type' => 'textarea',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946e6af2df19',
									'operator' => '!=',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 1,
						'formatting' => 'html',
					),
					array (
						'key' => 'field_5946e5a13eed8',
						'label' => 'Subheading Text',
						'name' => 'avi_slide_subtext',
						'type' => 'textarea',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946e6af2df19',
									'operator' => '!=',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 2,
						'formatting' => 'html',
					),
					array (
						'key' => 'field_5947335ce94e9',
						'label' => 'Button 1',
						'name' => 'avi_slide_button_1',
						'type' => 'avi-acf-button',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946e6af2df19',
									'operator' => '!=',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'link' => '',
						'text' => '',
						'style' => 'flat_rounded',
						'size' => 'medium',
						'color' => '',
						'icon' => '',
						'iconalign' => 'right',
						'reveal' => 0,
						'newtab' => 0,
						'button' => '',
						'textcolor' => '',
					),
					array (
						'key' => 'field_59473c1b6c9ba',
						'label' => 'Button 2',
						'name' => 'avi_slide_button_2',
						'type' => 'avi-acf-button',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946e6af2df19',
									'operator' => '!=',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'link' => '',
						'text' => '',
						'style' => 'flat_rounded',
						'size' => 'medium',
						'color' => '',
						'icon' => '',
						'iconalign' => 'right',
						'reveal' => 0,
						'newtab' => 0,
						'button' => '',
						'textcolor' => '',
					),
					array (
						'key' => 'field_5946e7172df1a',
						'label' => 'HTML',
						'name' => 'avli_slide_html',
						'type' => 'textarea',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5946e6af2df19',
									'operator' => '==',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => '',
						'formatting' => 'html',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'avi_slide',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'default',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
			register_field_group(array (
				'id' => 'acf_slider-settings',
				'title' => 'Slider Settings',
				'fields' => array (
					array (
						'key' => 'field_594549136cf27',
						'label' => 'Display',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_594549366cf28',
						'label' => 'Parallax',
						'name' => 'avi_slider_parallax',
						'type' => 'true_false',
						'message' => '',
						'default_value' => 0,
					),
					// array (
					// 	'key' => 'field_59458035df913',
					// 	'label' => 'Slides to show',
					// 	'name' => 'avli_slider_slides_to_show',
					// 	'type' => 'number',
					// 	'instructions' => 'Number of image to show per slide.',
					// 	'default_value' => 1,
					// 	'placeholder' => '',
					// 	'prepend' => '',
					// 	'append' => '',
					// 	'min' => '',
					// 	'max' => '',
					// 	'step' => '',
					// ),
					array (
						'key' => 'field_59458073df914',
						'label' => 'Slider Height',
						'name' => 'avi_slider_height',
						'type' => 'select',
						'choices' => array (
							'full' => 'Full Screen',
							'custom' => 'Custom Height',
						),
						'default_value' => 'custom',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_594580e7df915',
						'label' => 'Height',
						'name' => 'avi_slide_height',
						'type' => 'number',
						'instructions' => 'Height in px (do not include px in the field).',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_59458073df914',
									'operator' => '==',
									'value' => 'custom',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => 550,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array (
						'key' => 'field_59458165df916',
						'label' => 'Navigation',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_59458175df917',
						'label' => 'Enable Swipe',
						'name' => 'avi_slider_swipe',
						'type' => 'true_false',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_5945818adf918',
						'label' => 'Loop Slides',
						'name' => 'avi_slider_loop',
						'type' => 'true_false',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_594581a8df919',
						'label' => 'Show Arrows',
						'name' => 'avi_slider_show_arrow',
						'type' => 'true_false',
						'message' => '',
						'default_value' => 1,
					),
					array (
						'key' => 'field_594581cfdf91a',
						'label' => 'Pagination',
						'name' => 'avi_slider_pagination',
						'type' => 'select',
						'choices' => array (
							'none' => 'None',
							'bullets' => 'Bullets',
							'progress' => 'Progress Bar',
							'thumbnail' => 'Thumbnail',
						),
						'default_value' => 'none',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5945825ddf91d',
						'label' => 'Animation',
						'name' => '',
						'type' => 'tab',
					),
					array (
						'key' => 'field_59458267df91e',
						'label' => 'Autoplay',
						'name' => 'avi_slider_autoplay',
						'type' => 'true_false',
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_59458274df91f',
						'label' => 'Autoplay Speed',
						'name' => 'avi_slider_autoplay_speed',
						'type' => 'number',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_59458267df91e',
									'operator' => '==',
									'value' => '1',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => 5000,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					// array (
					// 	'key' => 'field_59458383df922',
					// 	'label' => 'Lazy Loading',
					// 	'name' => 'avi_slider_lazy_loading',
					// 	'type' => 'true_false',
					// 	'message' => '',
					// 	'default_value' => 0,
					// ),
					array (
						'key' => 'field_5945829ddf920',
						'label' => 'Animation Speed',
						'name' => 'avi_slider_animation_speed',
						'type' => 'number',
						'default_value' => 300,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
					array (
						'key' => 'field_594582d8df921',
						'label' => 'Animation Type',
						'name' => 'avi_slider_slide_animation_type',
						'type' => 'select',
						'choices' => array (
							'slide' => 'Slide',
							'fade' => 'Fade',
							'cube' => '3D Cube',
							'coverflow' => '3D Coverflow',
							'flip' => '3D Flip',
						),
						'default_value' => 'slide',
						'allow_null' => 0,
						'multiple' => 0,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'ef_taxonomy',
							'operator' => '==',
							'value' => 'avi_slider',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'default',
					'hide_on_screen' => array (
						0 => 'slug',
					),
				),
				'menu_order' => 0,
			));
		}



	}

	/*===========================================================
							Extra functions
	  ===========================================================*/

    /**
    * Get all registered sidebars
    *
    * @return array
    */
	public function get_sidebars() {

		global $wp_registered_sidebars;

		$sidebars = array();
		$sidebars['disable'] = 'None';
		$sidebars['default'] = 'Default';

		foreach ( $wp_registered_sidebars as $key => $val ) {
			$sidebars[$key] = $val['name'];
		}

		return $sidebars;
	}

    /**
    * Get list of public post types.
    *
    * @return array
    */
	private function get_public_post_types() {

		$args = array(
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
		);

		$get_post_types = get_post_types($args);
		$get_post_types['page'] = 'page';

		$post_types = array();
		$group_no = 0;

		foreach ($get_post_types as $value) {
			
			$post_types[] = array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => $value,
						'order_no' => 0,
						'group_no' => $group_no++,
					),
				);
		}

		return $post_types;
	}

} // end Class

new Avi_Metaboxes();