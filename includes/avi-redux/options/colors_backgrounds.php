<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Colors options
 */
function avi_option_section_colors_backgrounds() {

    $preset = Avi_Options::$preset;

    $section = array(
        array(
            'title' => __( 'Colors', 'avi' ),
            'id' => 'avi-colors',
            'desc' => __( '', 'avi' ),
            'icon' => 'icon-colors_background_images',
        ),
            array(
                'title'      => __( 'Color Scheme', 'avi' ),
                'id'         => 'avi-general-color',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'avi-color-scheme',
                        'type'     => 'radio',
                        'title'    => __('Color Scheme', 'avi'), 
                        'subtitle' => __('', 'avi'),
                        'class'    => 'scheme-selector',
                        'options'  => Avi_Options_Functions::color_selection(),
                        'default'  => '1ABC9C'
                    ),
                    array(
                        'id'       => 'avi-custom-color-opt',
                        'type'     => 'switch',
                        'title'    => __( 'Use Custom Color', 'avi' ),
                        'subtitle' => __( 'This will override the color above if enabled.', 'avi' ),
                        'on'       => 'Yes',
                        'off'      => 'No',
                        'default'  => false
                    ),
                        array(
                           'id' => 'section-start-coloropt',
                           'type' => 'section',
                           'title' => '',
                           'subtitle' => '',
                           'indent' => true 
                        ),
                            array(
                                'id'       => 'avi-custom-color',
                                'required' => array( 'avi-custom-color-opt', '=', '1' ),
                                'type'     => 'color',
                                'title'    => __('Custom Color', 'avi'),
                                'subtitle' => __('Select a color', 'avi'),
                                'validate' => 'color',
                                'transparent' => false,
                                'default' => ''
                            ),   
                        array(
                            'id'     => 'section-end-coloropt',
                            'type'   => 'section',
                            'indent' => false,
                        ),
                    array(
                        'id'       => 'avi-color-contrast',
                        'type'     => 'radio',
                        'title'    => __('Color Contrast', 'avi'), 
                        'subtitle' => __('Completely change the contrast of the website to Dark or Light.', 'avi'),
                        'options'  => array(
                                '1' => 'Light',
                                '2' => 'Dark'
                            ),
                        'default'  => '1'
                    ),                
                )
            ),  
            array(
                'title'      => __( 'Site Header', 'avi' ),
                'id'         => 'avi-heades-color-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'avi-top-header-dark',
                        'type'     => 'switch',
                        'title'    => __( 'Top header dark', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => false
                    ),
                    array(
                        'id'        => 'avi-top-bg',
                        'type'      => 'background',
                        'title'     => 'Top Header Background',
                        'output' => array('.dark #top-bar, #top-bar'),
                        'transparent' => false,
                        'default' => ''
                    ),
                    array(
                        'id'       => 'avi-main-header-dark',
                        'type'     => 'switch',
                        'title'    => __( 'Main header dark', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => false
                    ),                    
                    array(
                        'id'        => 'avi-main-header-bg',
                        'type'      => 'background',
                        'title'     => 'Main Header Background',
                        'output' => array('#header:not(.transparent-header), #header.dark:not(.transparent-header), .dark #header:not(.transparent-header), #header.sticky-header #header-wrap, .dark #header.sticky-header:not(.transparent-header) #header-wrap:not(.not-dark), #header.dark.sticky-header:not(.transparent-header) #header-wrap:not(.not-dark), #header.dark.sticky-header.transparent-header #header-wrap:not(.not-dark)'),
                        'transparent' => false,
                        'default' => ''
                    ),
                ),
            ),
            array(
                'title'      => __( 'Page Title Bar', 'avi' ),
                'id'         => 'avi-titlebar-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'avi-page-header-bg',
                        'type'      => 'background',
                        'title'     => 'Page Header Background',
                        'output' => array('#page-title'),
                        'transparent' => false,
                        'default' => ''
                    ),
                ),
            ),
            array(
                'title'      => __( 'Menu', 'avi' ),
                'id'         => 'avi-menu-color-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(        
                    array(
                        'id'       => 'avi-top-item-bg',
                        'type'     => 'link_color',
                        'title'    => __('Top level Item Background Color', 'avi'),
                        'default' => ''
                    ),
                    array(
                        'id'       => 'avi-submenu-bg',
                        'type'     => 'link_color',
                        'title'    => __('Submenu Background Color', 'avi'),
                        'default' => ''
                    )            
                ),
            ),
            array(
                'title'      => __( 'Body', 'avi' ),
                'id'         => 'avi-body-bg-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'avi-body-bg',
                        'type'      => 'background',
                        'title'     => 'Content Background',
                        'output'    => array('.dark #content, #content'),
                        'transparent' => false,
                        'default' => ''
                    ),
                    array(
                        'id'        => 'avi-boxed-body-bg',
                        'type'      => 'background',
                        'output'    => array('body.dark, body'),
                        'title'     => 'Boxed Layout Background',
                        'transparent' => false,
                        'default' => ''
                    ),               
                ),
            ),
            array(
                'title'      => __( 'Footer', 'avi' ),
                'id'         => 'avi-sidebar-footer-bg-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'        => 'avi-footer-bg',
                        'type'      => 'background',
                        'title'     => 'Footer Background Color',         
                        'output' => array('#footer, .dark #footer'),
                        'transparent' => false,
                        'default' => ''
                    ),
                    array(
                        'id'        => 'avi-footer-bottom-area-bg',
                        'type'      => 'background',
                        'title'     => 'Footer Bottom Area Background Color',                    
                        'output' => array('#copyrights, .dark #copyrights'),
                        'transparent' => false,
                        'default' => ''
                    ),           
                ),
            )
    );

    return $section;
}