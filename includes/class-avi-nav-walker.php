<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check
/**
 * Custom nav walker
 *
 * @package avi
 * @version 1.0.0
 */

class Avi_Nav_Walker extends Walker_Nav_Menu {

	var $is_megamenu = 0;

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		/* for <li> */
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );


		if ( $args->has_children ) {
			$class_names .= ' sub-menu';
		}
		if ( in_array( 'current-menu-item', $classes ) ) {
			$class_names .= ' current';
		}
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		/* end </li> */

		$atts = array();
		$atts['title']  = ! empty( $item->title )	? $item->title	: '';
		$atts['target'] = ! empty( $item->target )	? $item->target	: '';
		$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

		$anchor_class = (array_key_exists('anchor_class', $args))? $args->anchor_class : '';

		// If item has_children add atts to a.
		if ( $args->has_children && $depth === 0 ) {
			// $atts['href']   		= ( $option['avi-parent-menu-click'] && !empty( $item->url ) ) ? $item->url : '';
			$atts['href'] = $item->url;
			$atts['class']			= 'dropdown-toggle';
			$atts['aria-haspopup']	= 'true';
		} else {
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			$atts['class'] = '';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		
		$attributes = '';

		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );

				if($attr === 'class') {
					$attributes .= ' '. $attr . '="' . $value . ' '. $anchor_class .'"';
				}

				$attributes .= ' '. $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		$item_output .= '<a '. $attributes .'>';

		$link_before  = $args->link_before;
		$link_before .= ( $item->icon !== '' || $item->subtitle !== '' )? '<div>' : '';
		$link_before .= ( $item->icon !== '' )? '<i class="'. esc_html($item->icon) .'"></i>' : '';
		
		$link_after  = ( $item->icon !== '' || $item->subtitle !== '' )? '</div>' : '';
		$link_after .= ( $item->subtitle !== '' )? '<span>'. esc_html($item->subtitle) .'</span>' : '';
		$link_after .= $args->link_after;

		$item_output .= $link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $link_after;
		// $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }


	
}