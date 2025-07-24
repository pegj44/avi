<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Page Title Header options
 */
function avi_option_section_page_title_header() {

    $preset  = Avi_Options::$preset;

    $section = array(
        array(
            'title' => __( 'Page Title Bar', 'avi' ),
            'id' => 'avi-header-menu',
            'desc' => __( '', 'avi' ),
            'icon' => 'icon-headers__menu',
            'fields' => array(
                array(
                    'id'       => 'avi-page-header',
                    'type'     => 'checkbox',
                    'title'    => __('Page Title Bar', 'avi'), 
                    'subtitle' => __('<p>Show page header in the following pages.</p>', 'avi'),
                    'options'  => array(
                        'blog' => 'Blog',
                        'archive' => 'Archives',
                        'page' => 'Page',
                        'shop' => 'Shop'
                    ),
                    'default' => array(
                        'blog' => '1',
                        'archive' => '1',
                        'page' => '1',
                        'shop' => '1'
                    )
                ),
                array(
                   'id' => 'section-start-pageheader',
                   'type' => 'section',
                   'title' => __('Blog Headings', 'avi'),
                   'indent' => true,
                ), 
                    array(
                        'id'          => 'avi-blog-pageheader-txt',
                        'type'        => 'text',
                        'title'       => __( 'Heading Text', 'avi' ),
                        'subtitle'    => __( '', 'avi' ),
                        'placeholder' => '',
                        'default'     => __('Blog', 'avi')
                    ),
                    array(
                        'id'          => 'avi-blog-subheader-txt',
                        'type'        => 'text',
                        'title'       => __( 'Subheading Text', 'avi' ),
                        'subtitle'    => __( '', 'avi' ),
                        'placeholder' => '',
                        'default'     => __('Our Latest News', 'avi'),                
                    ),                 
                array(
                    'id'     => 'section-end',
                    'type'   => 'section',
                    'indent' => false,
                ),

                array(
                   'id' => 'section-start-shopheader',
                   'type' => 'section',
                   'title' => __('Shop Headings', 'avi'),
                   'indent' => true,
                ), 
                    array(
                        'id'          => 'avi-shop-pageheader-txt',
                        'type'        => 'text',
                        'title'       => __( 'Heading Text', 'avi' ),
                        'subtitle'    => __( '', 'avi' ),
                        'placeholder' => '',
                        'default'     => __('Shop', 'avi')
                    ),
                    array(
                        'id'          => 'avi-shop-subheader-txt',
                        'type'        => 'text',
                        'title'       => __( 'Subheading Text', 'avi' ),
                        'subtitle'    => __( '', 'avi' ),
                        'placeholder' => '',
                        'default'     => ''
                    ),                 
                array(
                    'id'     => 'section-end-shopheader',
                    'type'   => 'section',
                    'indent' => false,
                ),
            )    
        )
    );

    return $section;
}