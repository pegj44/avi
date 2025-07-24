<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Typography options
 */
function avi_option_section_typography() {

    $preset = Avi_Options::$preset;

    $section = array(
        array(
            'title' => __( 'Typography', 'avi' ),
            'id' => 'avi-typo',
            'icon' => 'icon-typography',
        ),
            array(
                'title'      => __( 'General', 'avi' ),
                'id'         => 'avi-general-typo',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(        
                    array(
                        'id'          => 'avi-general-typo',
                        'type'        => 'typography',
                        'title'       => __( 'General Typography', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,            
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( 'body', '#content p' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => array(
                            'font-family' => 'Lato'
                        )
                    ),
                    array(
                        'id'          => 'avi-links-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Links', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        'color'         => false,            
                        'text-transform' => true,
                        'all_styles'  => true,  
                        'text-align' => false,
                        'output'      => array( 'a' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),
                    array(
                        'id'     => 'avi-links-colors-typo',
                        'type'   => 'link_color',
                        'active' => false,
                        'visited' => true,
                        'important' => true,
                        'output' => array( 'a' ),
                        'default' => ''
                    ),
                    array(
                        'id'          => 'avi-h1-typo',
                        'type'        => 'typography',
                        'title'       => __( 'H1 font style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,   
                        'text-align'  => false,
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( 'h1' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => array(
                            'font-family' => 'Raleway',
                            'font-weight' => '600'
                        )
                    ),

                    array(
                        'id'          => 'avi-h2-typo',
                        'type'        => 'typography',
                        'title'       => __( 'H2 font style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,    
                        'text-align'  => false,        
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( 'h2' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => array(
                            'font-family' => 'Raleway',
                            'font-weight' => '600'
                        )
                    ),

                    array(
                        'id'          => 'avi-h3-typo',
                        'type'        => 'typography',
                        'title'       => __( 'H3 font style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,
                        'text-align'  => false,
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( 'h3' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => array(
                            'font-family' => 'Raleway',
                            'font-weight' => '600'
                        )
                    ),

                    array(
                        'id'          => 'avi-h4-typo',
                        'type'        => 'typography',
                        'title'       => __( 'H4 font style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,   
                        'text-align'  => false,         
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( 'h4' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => array(
                            'font-family' => 'Raleway',
                            'font-weight' => '600'
                        )
                    ),

                    array(
                        'id'          => 'avi-h5-typo',
                        'type'        => 'typography',
                        'title'       => __( 'H5 font style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,            
                        'text-align'  => false,
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( 'h5' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => array(
                            'font-family' => 'Raleway',
                            'font-weight' => '600'
                        )
                    ),
                    array(
                        'id'          => 'avi-h6-typo',
                        'type'        => 'typography',
                        'title'       => __( 'H6 font style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,            
                        'text-align'  => false,
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( 'h6' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => array(
                            'font-family' => 'Raleway',
                            'font-weight' => '600'
                        )
                    ),

                ),
            ),
            array(
                'title'      => __( 'Menu', 'avi' ),
                'id'         => 'avi-menu-typo',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'          => 'avi-top-menu-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Top Level Font Style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        'color'         => false,            
                        'text-transform' => true,
                        'all_styles'  => true,  
                        'text-align' => false,
                        'output'      => array( '#primary-menu > ul > li > a' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),
                    array(
                        'id'     => 'avi-top-menu-color-typo',
                        'type'   => 'link_color',
                        'default' => array(
                                'regular' => '',
                                'active' => '',
                                'hover' => ''
                            )
                    ),
                    array(
                        'id'          => 'avi-submenu-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Submenu Font Style', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        'color'         => false,            
                        'text-transform' => true,
                        'all_styles'  => true,  
                        'text-align' => false,
                        'output'      => array( '#primary-menu ul ul a' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),
                    array(
                        'id'     => 'avi-submenu-color-typo',
                        'type'   => 'link_color',
                        'default' => array(
                                'regular' => '',
                                'active' => '',
                                'hover' => ''
                            )
                    ),
                ),
            ),
            array(
                'title'      => __( 'Page Title Bar', 'avi' ),
                'id'         => 'avi-page-header-typo-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'          => 'avi-page-header-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Page Title', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '.dark #page-title h1', '#page-title h1' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),
                    array(
                        'id'          => 'avi-titlebar-subheading-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Page Subtitle', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '#page-title span', '.dark #page-title span' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),                    
                    array(
                        'id'          => 'avi-page-header-meta-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Metadata', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '#page-title .entry-meta li, #page-title .entry-meta li a, #page-title span' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ), 
                ),
            ),
            array(
                'title'      => __( 'Title & Metadata', 'avi' ),
                'id'         => 'avi-titlemeta-typo-opt',
                'desc'       => __( 'If page title bar is disabled then the style below will apply.', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'          => 'avi-article-title-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Page Title', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '.entry-title h2, .archive-heading h1' ),  
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ), 
                    array(
                        'id'          => 'avi-article-subheading-typo',
                        'type'        => 'typography',
                        'title'       => __( 'Page Subtitle', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '#page-title span' ),  
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ), 
                    array(
                        'id'          => 'avi-post-meta-typography',
                        'type'        => 'typography',
                        'title'       => __( 'Metadata', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '.entry-meta li a' ),     
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ), 
                ),
            ),
            array(
                'title'      => __( 'Breadcrumbs', 'avi' ),
                'id'         => 'avi-breacrumbs-typo-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'          => 'avi-breadcrumbs-typography',
                        'type'        => 'typography',
                        'title'       => __( 'Breadcrumbs Text Styles', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,            
                        'text-transform' => true,
                        'all_styles'  => true,  
                        'text-align' => false,
                        'output'      => array( '.dark .breadcrumb a:hover', '.dark .breadcrumb a', '.breadcrumb > li', '.breadcrumb li a', '.breadcrumb li a:hover', '.breadcrumb li a:visited', '.breadcrumb i', '.breadcrumb > .active' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),
                    // array(
                    //     'id'     => 'avi-breadcrumbs-color-typography',
                    //     'type'   => 'link_color',
                    //     'output' => array( '.breadcrumb li a' ),
                    //     'default' => $preset['avi-breadcrumbs-color-typography']
                    // ),
                ),
            ),
            array(
                'title'      => __( 'Sidebar', 'avi' ),
                'id'         => 'avi-sidebar-typo-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'          => 'avi-widget-typography',
                        'type'        => 'typography',
                        'title'       => __( 'Sidebar Widget Title', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '.sidebar .widget > h4' ),
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),    
                    array(
                        'id'          => 'avi-widget-text-typography',
                        'type'        => 'typography',
                        'title'       => __( 'Sidebar Widget Text', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '.sidebar p', '.sidebar span', '.sidebar' ),
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ), 
                ),
            ),
            array(
                'title'      => __( 'Footer', 'avi' ),
                'id'         => 'avi-footer-typo-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'          => 'avi-footer-widgettitle-font',
                        'type'        => 'typography',
                        'title'       => __( 'Footer Widget Title', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '#footer .widget > h4' ),
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),    
                    array(
                        'id'          => 'avi-footer-widgettxt-font',
                        'type'        => 'typography',
                        'title'       => __( 'Footer Widget Text', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false                    
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '#footer .widget', '#footer .widget ul li a', '#footer .widget a', '#footer .widget p', '#footer .widget span' ),
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ), 
                    array(
                        'id'          => 'avi-footer-copyright-typography',
                        'type'        => 'typography',
                        'title'       => __( 'Footer Copyright text', 'avi' ),                                    
                        'font-backup' => false,            
                        'subsets'       => false, // Only appears if google is true and subsets not set to false            
                        // 'color'         => false,
                        'text-transform' => true,
                        'all_styles'  => true,            
                        'output'      => array( '#copyrights', '#copyrights p', '#copyrights span' ),        
                        'units'       => 'px',            
                        'subtitle'    => __( '', 'avi' ),
                        'default' => ''
                    ),            
                ),
            )

    );

    return $section;
}