<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Branding options
 */

function avi_option_section_branding() {

    $dir_url = Avi::$template_dir_url;
    $preset  = Avi_Options::$preset;

    $section = array(
        array(
            'title' => __( 'Branding', 'avi' ),
            'id' => 'avi-branding',
            'icon' => 'icon-branding'
        ),
        array(
            'title'      => __( 'Site Title & Tagline', 'avi' ),
            'id'         => 'avi-site-title-tagline',
            'subsection' => true,
            'desc'       => __( '', 'avi' ),
            'fields'     => array(
                array(
                    'id'          => 'avi-site-title',
                    'type'        => 'text',
                    'title'       => __( 'Site Title', 'avi' ),
                    'subtitle'    => __( '', 'avi' ),
                    'placeholder' => __( 'Site title', 'avi' ),
                    'default'     => get_bloginfo('name', 'display'),
                    'customizer' => true
                ),    
                array(
                    'id'          => 'avi-site-tagline',
                    'type'        => 'text',
                    'title'       => __( 'Site tagline', 'avi' ),
                    'subtitle'    => __( 'In a few words, explain what this site is about.', 'avi' ),
                    'placeholder' => __( 'Site tagline', 'avi' ),
                    'default'     => get_bloginfo('description', 'display')
                ),
            )
        ),
        array(
            'title'      => __( 'Logo & Favicon', 'avi' ),
            'id'         => 'avi-logo-favicon',
            'subsection' => true,
            'desc'       => __( '', 'avi' ),
            'fields'     => array(                 
                array(
                    'id'       => 'avi-logo',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Logo', 'avi' ),
                    'compiler' => 'true',
                    'subtitle' => __( '', 'avi' ),
                    'default'  => array(
                            'url' => ''
                        )
                ),
                array(
                    'id'       => 'avi-logo-retina',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Retina Logo', 'avi' ),
                    'compiler' => 'true',
                    'subtitle' => __( '', 'avi' ),
                    'default'  => array(
                            'url' => ''
                        )
                ),
                array(
                    'id'       => 'avi-alternate-logo',
                    'type'     => 'switch',
                    'title'    => __( 'Alternate Logo', 'avi' ),
                    'subtitle' => __( 'Upload alternate logo for sticky header.', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => 'off'
                ),
                    array(
                       'id' => 'section-start-alt-logo',
                       'type' => 'section',
                       'title' => __('', 'avi'),
                       'subtitle' => __('', 'avi'),
                       'indent' => true,
                       'required' => array( 'avi-alternate-logo', '=', '1' ), 
                    ), 
                        array(
                            'id'       => 'avi-alt-standard-logo',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Alternate Logo', 'avi' ),
                            'compiler' => 'true',
                            'subtitle' => __( '', 'avi' ),
                            'default'  => array(
                                'url' => ''
                            )
                        ),
                array(
                    'id'     => 'section-end-alt-logo',
                    'type'   => 'section',
                    'indent' => false,
                ),
                array(
                    'id'       => 'avi-mobile-logo',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Mobile Logo', 'avi' ),
                    'compiler' => 'true',
                    'subtitle' => __( '', 'avi' ),
                    'default'  => array(
                            'url' => ''
                        )
                ),            
                array(
                    'id'       => 'avi-favicon',
                    'type'     => 'media',
                    'url'      => true,
                    'title'    => __( 'Favicon', 'avi' ),
                    'compiler' => 'true',
                    //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                    'subtitle' => __( 'The Site Icon is used as a browser and app icon for your site. Icons must be square, and at least <strong>512</strong> pixels wide and tall.', 'avi' ),                
                    'default'  => array(
                            'url' => ''
                        )
                ),               
            )
        )
    );

    return $section;
}