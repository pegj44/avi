<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Custom CSS
 */
function avi_option_section_custom_css() {

    $section = array(
        array(
            'title' => __( 'Custom CSS', 'avi' ),
            'id' => 'avi-custom-css-area',
            'desc' => __( '', 'avi' ),
            'icon' => 'icon-custom_css',
            'fields' => array(
                array(
                    'id'       => 'avi-custom-css',
                    'type'     => 'ace_editor',
                    'title'    => __( 'CSS Code', 'avi' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                )
            ),
        )
    );

    return $section;
}