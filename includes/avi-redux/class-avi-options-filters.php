<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme option filters class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Options_Filters {

    /**
     * Constructor
     *
     * @access public
     */
    public function __construct() {
        
        add_filter( 'avi_social_buttons', array( $this, 'get_social_buttons' ), 10, 3);
        add_filter( 'avi_color_scheme', array( $this, 'get_color_scheme' ) );
        add_filter( 'body_class', array( $this, 'avi_body_class' ) );
    }

    /**
     * Custom color scheme
     *
     * @access public
     * @param array
     * @return array
     */
    public function get_color_scheme($colors) {

        return $colors;
    }

    /**
     * Append body class
     *
     * @access public
     * @param array
     * @return array     
     */    
    public function avi_body_class( $default ) {

        global $option;
        global $wp_query;

        $header  = $option['avi-header-layout'];   
        $classes = array(
                'dark' => ( $option['avi-color-contrast'] === '2' ),
                'no-transition' => !$option['avi-siteloader'],
                'stretched' => ( !$option['avi-boxed-layout'] ),
                'device-lg' => true,
                'overlay-menu' => ( $header === 'header8' ),
                'rtl' => $option['avi-rtl'],
                'side-header-right' => ( $header === 'header9' ),
                'side-header-left' => ( $header === 'header10' ),
                'masonry-full' => ( ((is_archive() && $option['avi-archive-num-col'] === '5') || (is_home() && $option['avi-blog-num-col'] === '5' )) && !$wp_query->is_post_type_archive ),
                'avi-menu-align-'. $option['avi-menu-align'] => $option['avi-menu-align']
            );

        $classes   = array_filter($classes);
        $classes   = array_keys($classes);
        $side_head = array( 'side-header', 'open-header', 'push-wrapper', 'close-header-on-scroll' );

        if( $header === 'header9' || $header === 'header10' ) {
            $classes = array_merge( $classes , $side_head );
        }

        $classes = array_merge($default, $classes);

        return $classes;
    }

    function get_social_buttons($html = '', $socials = array(), $type = '') {

        global $option;

        $type = ( $type && isset($option['avi-'. $type .'-style-color']) )? $type : 'footerbtn';

        $style = array(
                'style1' => array('si-standard', 'style' => array('color:'. $option['avi-'. $type .'-style-color'] .' !important;', 'border: 1px solid '. $option['avi-'. $type .'-style-color'] .';')),
                'style2' => array('si-dark', 'style' => array('background:'. $option['avi-'. $type .'-style-color'] .';')),
                'style3' => array('si-light', 'style' => array('color:'. $option['avi-'. $type .'-style-color'] .' !important;')),
                'style4' => array('si-rounded', 'style' => array('color:'. $option['avi-'. $type .'-style-color'] .' !important;', 'border: 1px solid '. $option['avi-'. $type .'-style-color'] .';')),
                'style5' => array('si-dark si-rounded', 'style' => array('background:'. $option['avi-'. $type .'-style-color'] .';')),
                'style6' => array('si-light si-rounded', 'style' => array('color:'. $option['avi-'. $type .'-style-color'] .' !important;')),
                'style7' => array('si-borderless', 'style' => array('color:'. $option['avi-'. $type .'-style-color'] .' !important;')),
                'style8' => array('si-borderless si-text-color', 'style' => array()),
                'style9' => array('si-colored', 'style' => array())
            );

        $out = '';

        foreach ($socials as $key => $val) {            

            $link = ( $val['title'] == 'Skype' )? esc_attr( 'skype:'. $val['link'] .'?add' ) : $val['link'];

            $out .= preg_replace(
                array('/{link}/', '/{class}/', '/{icon}/', '/{style}/', '/{name}/'), 
                array(preg_replace(array('/{title}/', '/{url}/'), array(get_the_title(), get_permalink()), $link),
                    $style[$option['avi-'. $type .'-style']][0] .' si-'. $option['avi-'. $type .'-size'] .' '. $val['class'],
                    $val['icon'],
                    implode(' ', $style[$option['avi-'. $type .'-style']]['style']),
                    $val['title']
                ), 
                $html
            );
        }

        return $out;
    }

} // end class