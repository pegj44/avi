<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Script options
 */
function avi_option_section_scripts() {

    $section = array(
        array(
            'title' => __( 'Scripts', 'avi' ),
            'id' => 'avi-scripts',
            'icon' => 'icon-scripts',
            'desc' => __( '', 'avi' ),
            'subsection' => false,
            'fields' => array(
                array(
                    'id'       => 'avi-header-scripts',
                    'type'     => 'ace_editor',
                    'title'    => __( 'Header Scripts', 'avi' ),
                    'subtitle' => __( 'Paste header scripts here. It can be google analytics or any js scripts.', 'avi' ),
                    'mode'     => 'javascript',
                    'theme'    => 'monokai',
                ),
                array(
                    'id'       => 'avi-header-ad',
                    'type'     => 'ace_editor',
                    'title'    => __( 'Header 720x90 AD', 'avi' ),
                    'subtitle' => __( 'For header type "Header 3" only.', 'avi' ),
                    'mode'     => 'html',
                    'theme'    => 'monokai',
                    'default'  => '<img src="'. Avi::$template_dir_url .'/assets/img/ad.jpg" alt="Ad">'            
                ),         
                array(
                    'id'       => 'avi-footer-scripts',
                    'type'     => 'ace_editor',
                    'title'    => __( 'Footer Scripts', 'avi' ),
                    'subtitle' => __( 'Paste footer scripts here. It can be google analytics or any js scripts.', 'avi' ),
                    'mode'     => 'javascript',
                    'theme'    => 'monokai',
                )                   
            )
        )
    );

    return $section;
}