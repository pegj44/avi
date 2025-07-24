<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Post options
 */
function avi_option_section_post_page() {

    $preset  = Avi_Options::$preset;

    $section = array(
        array(
            'title'   => __( 'Single Post / Page', 'avi' ),
            'id'  => 'avi-post-page-opt',
            'desc' => __( '', 'avi' ),
            'icon' => 'icon-post_page',
            'fields'           => array(
                array(
                    'id'       => 'avi-single-post-show-related',
                    'type'     => 'switch',
                    'title'    => __( 'Related Posts', 'avi' ),
                    'subtitle' => __( 'Show related posts in single post.', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => true
                ),            
                array(
                    'id'       => 'avi-post-author',
                    'type'     => 'switch',
                    'title'    => __('Post Author', 'avi'), 
                    'subtitle' => __( 'Display author in single post together with their bio.', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => true
                ),
                array(
                    'id'       => 'avi-post-tag',
                    'type'     => 'switch',
                    'title'    => __('Post Meta Tags', 'avi'), 
                    'subtitle' => __( 'Display post meta tags in single post.', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => true
                ),        
                array(
                    'id'       => 'avi-postpage-meta',
                    'type'     => 'checkbox',
                    'title'    => __('Show Metadata:', 'avi'), 
                    'options'  => array(
                        'single' => 'Post',
                        'page' => 'Page',
                    ),
                    'default'  => array(
                            'single' => '1'
                        )
                ),
                array(
                    'id'       => 'avi-singular-meta',
                    'type'     => 'checkbox',
                    'title'    => __('Metadata', 'avi'), 
                    'subtitle' => __('', 'avi'),
                    'options'  => array(
                        'date' => 'Date',
                        'author' => 'Author',                
                        'comments' => 'Number of Comments',
                        'category' => 'Categories <em>(for post only)</em>',
                        'format' => 'Post Format <em>(for post only)</em>',
                    ),
                    'default' => array(
                            'date' => '1',
                            'author' => '1',
                            'category' => '1'
                        )
                ),          
                array(
                    'id'       => 'avi-next-prev',
                    'type'     => 'checkbox',
                    'title'    => __('Next / Prev Link', 'avi'), 
                    'options'  => array(
                        'single' => 'Post',
                        'page' => 'Page',
                    ),
                    'default'  => array(
                            'single' => '1'
                        )
                ),                
            )
        )
    );

    return $section;
}