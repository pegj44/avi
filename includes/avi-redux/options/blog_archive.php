<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Blog / Archive options
 */
function avi_option_section_blog_archive() {

    $preset = Avi_Options::$preset;

    $section = array(
        array(
            'title' => __( 'Blog / Archive', 'avi' ),
            'id' => 'avi-blog-archive',
            'desc' => __( '', 'avi' ),
            'icon' => 'icon-blog_archive',
            'avi_customizer' => true,
            'fields' => array(
                array(
                    'id'          => 'avi-archive-num-posts',
                    'type'        => 'text',
                    'title'       => __( 'Number of archive posts to be displayed', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => '',
                    'validate'    => 'numeric_not_empty',
                    'default'     => 10,
                ),  
                array(
                    'id'       => 'avi-archive-meta',
                    'type'     => 'checkbox',
                    'title'    => __('Metadata', 'avi'), 
                    'subtitle' => __('Show the following metadata in blog page and archive.', 'avi'),
                    'options'  => array(
                        'date' => 'Date',
                        'author' => 'Author',
                        'category' => 'Categories',
                        'comments' => 'Number of Comments',
                        'format' => 'Post Format',
                    ),
                    'default' => array(
                            'date' => '1',
                            'author' => '1',
                            'category' => '1'
                        )
                ),        
                array(
                    'id'       => 'avi-masonry',
                    'type'     => 'checkbox',
                    'title'    => __('Masonry', 'avi'), 
                    'options'  => array(
                        'blog' => 'Blog',
                        'archive' => 'Archives',
                    ),
                    'default'  => array(
                            'blog' => '1',
                            'archive' => '1'
                        )
                ),              
                array(
                    'id'       => 'avi-infinite-scroll',
                    'type'     => 'checkbox',
                    'title'    => __('Infinite Scroll', 'avi'), 
                    'options'  => array(
                        'blog' => 'Blog',
                        'archive' => 'Archives',
                    ),
                    'default'  => array(
                            'blog' => '1',
                            'archive' => '1' 
                        )
                ),  
            )   
        )
    );

    return $section;
}

