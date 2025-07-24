<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * General layout options
 */
function avi_option_section_layout() {

    $preset  = Avi_Options::$preset;
    $opt_dir = Avi_Options::$option_dir_url;

    $section = array(
        array(
            'title' => __( 'Site Layout', 'avi' ),
            'id' => 'avi-site-layout-opt',
            'desc' => __( '', 'avi' ),
            'icon' => 'icon-site_layout'
        ),
            array(
                'title'      => __( 'General', 'avi' ),
                'id'         => 'avi-general-layout-opt',
                'subsection' => true,
                'fields'     => array(          
                    array(
                        'id'       => 'avi-boxed-layout',
                        'type'     => 'switch',
                        'title'    => __( 'Boxed Layout', 'avi' ),
                        'subtitle' => __( 'Adjust site max width to 1220px.', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'avi-rtl',
                        'type'     => 'switch',
                        'title'    => __( 'RTL', 'avi' ),
                        'subtitle' => __( 'Change general layout from right to left.', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => false
                    ),                    
                   array(
                        'id'       => 'avi-blog-num-col',
                        'type'     => 'image_select',
                        'title'    => __('Blog Layout', 'avi'), 
                        'subtitle' => __('Choose layout for Blog page and single posts. This option can be overriden depending on sidebar layout.', 'avi'),
                        'options'  => array(
                            '1' => array(
                                'alt' => '1 Column',
                                'img' => $opt_dir . '/assets/img/col_0.png',
                                'title' => 'Single column'
                            ),
                            '2' => array(
                                'alt' => '2 Column',
                                'img' => $opt_dir . '/assets/img/col_2.png',
                                'title' => 'Two columns'
                            ),
                            '3' => array(
                                'alt' => '3 Column',
                                'img' => $opt_dir . '/assets/img/col_3.png',
                                'title' => 'Three columns'
                            ),
                            '4' => array(
                                'alt' => '4 Column',
                                'img' => $opt_dir . '/assets/img/col_4.png',
                                'title' => 'Four columns'
                            ), 
                            'left' => array(
                                'alt' => 'Image left Content Right',
                                'img' => $opt_dir . '/assets/img/col_l.png',
                                'title' => 'Single column, <br>image left and <br>content right'
                            ), 
                            'right' => array(
                                'alt' => 'Image Right Content Left',
                                'img' => $opt_dir . '/assets/img/col_r.png',
                                'title' => 'Single column, <br>image right and <br>content left'
                            ), 
                            'alternate' => array(
                                'alt' => 'Alternating image and content',
                                'img' => $opt_dir . '/assets/img/alternate.png',
                                'title' => 'Single column, <br>alternate image<br> and content'
                            ),                
                            '5' => array(
                                'alt' => 'Full Width Masonry',
                                'img' => $opt_dir . '/assets/img/masonry.png',
                                'title' => 'Four Columns <br>full width masonry. <br>Force remove sidebars.'
                            ), 
                        ),
                        'default' => '4'
                    ),
                   array(
                        'id'       => 'avi-archive-num-col',
                        'type'     => 'image_select',
                        'title'    => __('Archive Layout', 'avi'), 
                        'subtitle' => __('Choose layout for post archive. This option can be overriden depending on sidebar layout.', 'avi'),
                        'options'  => array(
                            '1' => array(
                                'alt' => '1 Column',
                                'img' => $opt_dir . '/assets/img/col_0.png',
                                'title' => 'Single column'
                            ),
                            '2' => array(
                                'alt' => '2 Column',
                                'img' => $opt_dir . '/assets/img/col_2.png',
                                'title' => 'Two columns'
                            ),
                            '3' => array(
                                'alt' => '3 Column',
                                'img' => $opt_dir . '/assets/img/col_3.png',
                                'title' => 'Three columns'
                            ),
                            '4' => array(
                                'alt' => '4 Column',
                                'img' => $opt_dir . '/assets/img/col_4.png',
                                'title' => 'Four columns'
                            ), 
                            'left' => array(
                                'alt' => 'Image left Content Right',
                                'img' => $opt_dir . '/assets/img/col_l.png',
                                'title' => 'Single column, <br>image left and <br>content right'
                            ), 
                            'right' => array(
                                'alt' => 'Image Right Content Left',
                                'img' => $opt_dir . '/assets/img/col_r.png',
                                'title' => 'Single column, <br>image right and <br>content left'
                            ), 
                            'alternate' => array(
                                'alt' => 'Alternating image and content',
                                'img' => $opt_dir . '/assets/img/alternate.png',
                                'title' => 'Single column, <br>alternate image<br> and content'
                            ),                
                            '5' => array(
                                'alt' => 'Full Width Masonry',
                                'img' => $opt_dir . '/assets/img/masonry.png',
                                'title' => 'Four Columns <br>full width masonry. <br>Force remove sidebars.'
                            ), 
                        ),                        
                        'default' => '4'
                    ),
                   array(
                        'id'       => 'avi-shop-num-col',
                        'type'     => 'image_select',
                        'title'    => __('Shop Layout', 'avi'), 
                        'subtitle' => __('Choose layout for e-commerce pages. This option can be overriden depending on sidebar layout.', 'avi'),
                        'options'  => array(
                            '2' => array(
                                'alt' => '2 Column',
                                'img' => $opt_dir . '/assets/img/col_2.png',
                                'title' => 'Two columns'
                            ),
                            '3' => array(
                                'alt' => '3 Column',
                                'img' => $opt_dir . '/assets/img/col_3.png',
                                'title' => 'Three columns'
                            ),
                            '4' => array(
                                'alt' => '4 Column',
                                'img' => $opt_dir . '/assets/img/col_4.png',
                                'title' => 'Four columns'
                            ), 
                            'left' => array(
                                'alt' => 'Image left Content Right',
                                'img' => $opt_dir . '/assets/img/col_l.png',
                                'title' => 'Single column, <br>image left and <br>content right'
                            ), 
                        ),                        
                        'default' => '4'
                    ),             
                ),
            ),
            array(
                'title'      => __( 'Header', 'avi' ),
                'id'         => 'avi-header-layout-opt',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'avi-sticky-header',
                        'type'     => 'switch',
                        'title'    => __( 'Sticky Header', 'avi' ),
                        'subtitle' => __( 'Make header sticky on scrolldown.', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => true
                    ),     
                    array(
                        'id'       => 'avi-header-width',
                        'type'     => 'switch',
                        'title'    => __( 'Full Width Header', 'avi' ),
                        'subtitle' => __( 'Make site header full-width. For full width layout only.', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => false
                    ),               
                    array(
                        'id'       => 'avi-top-header',
                        'type'     => 'switch',
                        'title'    => __( 'Top Navigation', 'avi' ),
                        'subtitle' => __( 'Enable top bar above site header.', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => false
                    ),
                        array(
                           'id' => 'section-start-topheader',
                           'type' => 'section',
                           'title' => __('', 'avi'),
                           'subtitle' => __('', 'avi'),
                           'indent' => true,
                           'required' => array( 'avi-top-header', '=', '1' ), 
                        ),           
                           array(
                                'id'       => 'avi-top-left',
                                'type'     => 'select',
                                'title'    => __('Left Area', 'avi'), 
                                'subtitle' => __('Choose element to be displayed on left area of top navigation.', 'avi'),
                                'options'  => array(
                                    'top-menu'     => __('Top Menu', 'avi'),
                                    'social-icons' => __('Social Icons', 'avi'),
                                    'phone-email'  => __('Phone & Email', 'avi'),                                    
                                    'custom-html' => __('Custom HTML', 'avi')
                                ),
                                'default'  => 'top-menu'
                            ),
                                array(
                                    'id' => 'avi-topleft-html',
                                    'type' => 'ace_editor',
                                    'title' => __('Top Left HTML', 'avi'),
                                    'subtitle' => __('', 'avi'),
                                    'indent' => true,
                                    'mode'     => 'html',
                                    'theme'    => 'monokai',                       
                                    'required' => array( 'avi-top-left', '=', 'custom-html' ), 
                                ),                    
                           array(
                                'id'       => 'avi-top-right',
                                'type'     => 'select',
                                'title'    => __('Right Area', 'avi'), 
                                'subtitle' => __('Choose element to be displayed on right area of top navigation.', 'avi'),
                                'options'  => array(
                                    'top-menu'     => 'Top Menu',
                                    'social-icons' => 'Social Icons',
                                    'phone-email'  => 'Phone & Email',
                                    'login'    => 'Login',
                                    'custom-html' => 'Custom HTML'
                                ),
                                'default'  => ''
                            ),
                                array(
                                   'id' => 'avi-topright-html',
                                   'type' => 'ace_editor',
                                   'title' => __('Top Right HTML', 'avi'),
                                   'subtitle' => __('', 'avi'),
                                   'indent' => true,
                                    'mode'     => 'html',
                                    'theme'    => 'monokai',                       
                                   'required' => array( 'avi-top-right', '=', 'custom-html' ), 
                                ),
                        array(
                            'id'     => 'section-end-topheader',
                            'type'   => 'section',
                            'indent' => false,
                        ),        
                        array(
                           'id' => 'avi-top-phone',
                           'type' => 'text',
                           'title' => __('Phone', 'avi'),
                           'subtitle' => __('', 'avi'),
                           'indent' => true,
                        ),
                        array(
                           'id' => 'avi-top-email',
                           'type' => 'text',
                           'title' => __('Email', 'avi'),
                           'subtitle' => __('', 'avi'),
                           'indent' => true,
                        ),             
                    array(
                        'id'       => 'avi-header-layout',
                        'type'     => 'image_select',
                        'title'    => __( 'Layout', 'avi' ),
                        'subtitle' => 'Choose header layout',
                        'class'    => 'avi-header-layout ',
                        'options'  => array(
                                'header1' => array(
                                    'alt' => 'Header 1',
                                    'img' => $opt_dir . '/assets/img/header1.png',
                                    'title' => 'Header 1: Logo inline.'
                                ),
                                'header2' => array(
                                    'alt' => 'Header 2',
                                    'img' => $opt_dir . '/assets/img/header2.png',
                                    'title' => 'Header 2: Logo inline and menu with subtitle.'
                                ),                                 
                                'header3' => array(
                                    'alt' => 'Header 3',
                                    'img' => $opt_dir . '/assets/img/header3.png',
                                    'title' => 'Header 3: Logo on top left <br>and menu on bottom.'
                                ),                    
                                'header4' => array(
                                    'alt' => 'Header 4',
                                    'img' => $opt_dir . '/assets/img/header4.png',
                                    'title' => 'Header 4: Header with 468x60 AD.'
                                ),
                                'header5' => array(
                                    'alt' => 'Header 5',
                                    'img' => $opt_dir . '/assets/img/header5.png',
                                    'title' => 'Header 5: Menu with large icons.'
                                ),                    
                                'header6' => array(
                                    'alt' => 'Header 6',
                                    'img' => $opt_dir . '/assets/img/header6.png',
                                    'title' => 'Header 6: Logo on top center <br>and menu on bottom center.'
                                ),
                                'header7' => array(
                                    'alt' => 'Header 7',
                                    'img' => $opt_dir . '/assets/img/header7.png',
                                    'title' => 'Header 7: Split menu.'
                                ),                    
                                'header8' => array(
                                    'alt' => 'Header 8',
                                    'img' => $opt_dir . '/assets/img/header8.png',
                                    'title' => 'Header 8: Navigation Overlay.'
                                ),
                                'header9' => array(
                                    'alt' => 'Header 9',
                                    'img' => $opt_dir . '/assets/img/header9.png',
                                    'title' => 'Header 9: Navigation <br>slide from right.'
                                ),
                                'header10' => array(
                                    'alt' => 'Header 10',
                                    'img' => $opt_dir . '/assets/img/header10.png',
                                    'title' => 'Header 10: Navigation <br>slide from left.'
                                ),                    
                            ),
                        'default' => 'header1'
                    )
                )
            ),
            array(
                'title'      => __( 'Site Menu', 'avi' ),
                'id'         => 'avi-site-menu-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                   array(
                        'id'       => 'avi-menu-align',
                        'type'     => 'select',
                        'title'    => __('Menu Alignment', 'avi'), 
                        'subtitle' => __('Center align only works if logo is above the menu.', 'avi'),
                        'options'  => array(
                            'left'     => 'Left',
                            'right' => 'Right',
                            'center'  => 'Center',
                        ),
                        'default'  => 'right'
                    ),          
                    array(
                        'id'       => 'avi-header-search',
                        'type'     => 'switch',
                        'title'    => __( 'Search Button', 'avi' ),
                        'subtitle' => __( '', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => true
                    ),
                    array(
                        'id'       => 'avi-header-cart',
                        'type'     => 'switch',
                        'title'    => __( 'Cart Button', 'avi' ),
                        'subtitle' => __( '', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => true
                    ),         
                )
            ),
            array(
                'title'      => __( 'Sidebar', 'avi' ),
                'id'         => 'avi-sidebar-layout-opt',
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'avi-custom-sidebar',
                        'type'     => 'multi_text',
                        'title'    => __( 'Add custom sidebar', 'avi' ),
                        'subtitle' => __( 'Custom sidebar will be added as widget area.', 'avi' ),
                    ),       
                    array(
                        'id'       => 'avi-blog-layout',
                        'type'     => 'image_select',
                        'title'    => __( 'Blog Sidebar', 'avi' ),
                        'subtitle' => __( 'Choose a sidebar layout for blog page and single post.', 'avi' ),
                        'options'  => array(
                            'no_sidebar' => array(
                                'alt' => '1 Column',
                                'img' => $opt_dir . '/assets/img/fullwidth.png'
                            ),
                            'blog-left-widget' => array(
                                'alt' => '2 Column Left',
                                'img' => $opt_dir . '/assets/img/left-sidebar.png'
                            ),
                            'blog-right-widget' => array(
                                'alt' => '2 Column Right',
                                'img' => $opt_dir . '/assets/img/right-sidebar.png'
                            ),
                            'both_sidebar' => array(
                                'alt' => '3 Column Both',
                                'img' => $opt_dir . '/assets/img/both-sidebar.png'
                            ),                
                        ),
                        'default' => 'blog-right-widget'
                    ),
                    array(
                        'id'       => 'avi-archive-layout',
                        'type'     => 'image_select',
                        'title'    => __( 'Archive Sidebar', 'avi' ),
                        'subtitle' => __( 'Choose a sidebar layout for archive page.', 'avi' ),
                        'options'  => array(
                            'no_sidebar' => array(
                                'alt' => '1 Column',
                                'img' => $opt_dir . '/assets/img/fullwidth.png'
                            ),
                            'archive-left-widget' => array(
                                'alt' => '2 Column Left',
                                'img' => $opt_dir . '/assets/img/left-sidebar.png'
                            ),
                            'archive-right-widget' => array(
                                'alt' => '2 Column Right',
                                'img' => $opt_dir . '/assets/img/right-sidebar.png'
                            ),
                            'both_sidebar' => array(
                                'alt' => '3 Column Both',
                                'img' => $opt_dir . '/assets/img/both-sidebar.png'
                            ),                
                        ),
                        'default' => 'archive-right-widget'
                    ), 
                    array(
                        'id'       => 'avi-page-layout',
                        'type'     => 'image_select',
                        'title'    => __( 'Page Sidebar', 'avi' ),
                        'subtitle' => __( 'Choose a sidebar layout for default page.', 'avi' ),
                        'options'  => array(
                            'no_sidebar' => array(
                                'alt' => '1 Column',
                                'img' => $opt_dir . '/assets/img/fullwidth.png'
                            ),
                            'page-left-widget' => array(
                                'alt' => '2 Column Left',
                                'img' => $opt_dir . '/assets/img/left-sidebar.png'
                            ),
                            'page-right-widget' => array(
                                'alt' => '3 Column Right',
                                'img' => $opt_dir . '/assets/img/right-sidebar.png'
                            ),
                            'both_sidebar' => array(
                                'alt' => '3 Column Both',
                                'img' => $opt_dir . '/assets/img/both-sidebar.png'
                            ),                    
                        ),
                        'default' => 'no_sidebar'
                    ),
                    array(
                        'id'       => 'avi-shop-layout',
                        'type'     => 'image_select',
                        'title'    => __( 'Shop Sidebar', 'avi' ),
                        'subtitle' => __( 'Choose a sidebar layout for shop page.', 'avi' ),
                        'options'  => array(
                            'no_sidebar' => array(
                                'alt' => '1 Column',
                                'img' => $opt_dir . '/assets/img/fullwidth.png'
                            ),
                            'shop-left-widget' => array(
                                'alt' => '2 Column Left',
                                'img' => $opt_dir . '/assets/img/left-sidebar.png'
                            ),
                            'shop-right-widget' => array(
                                'alt' => '2 Column Right',
                                'img' => $opt_dir . '/assets/img/right-sidebar.png'
                            ),
                            'both_sidebar' => array(
                                'alt' => '3 Column Both',
                                'img' => $opt_dir . '/assets/img/both-sidebar.png'
                            ),                
                        ),
                        'default' => 'shop-right-widget'
                    ), 
                )     
            ),
            array(
                'title'      => __( 'Footer', 'avi' ),
                'id'         => 'avi-footer-layout-opt',
                'subsection' => true,
                'fields'     => array(    
                    array(
                        'id'       => 'avi-footer-col',
                        'type'     => 'image_select',
                        'title'    => __( 'Footer widget areas', 'avi' ),
                        'subtitle' => __( 'Choose layout for footer widget area. Footer widget area is hidden if there are no active widgets placed.', 'avi' ),
                        'options'  => array(
                            'one' => array(
                                'alt' => '1 Column',
                                'img' => $opt_dir . '/assets/img/widget1.png',
                                'title' => '1/1'
                            ),
                            'two' => array(
                                'alt' => '2 Columns',
                                'img' => $opt_dir . '/assets/img/widget2.png',
                                'title' => '1/2'
                            ),
                            'two_b' => array(
                                'alt' => '2 Columns',
                                'img' => $opt_dir . '/assets/img/widget3.png',
                                'title' => '2/3 + 1/3'
                            ),
                            'two_c' => array(
                                'alt' => '2 Columns',
                                'img' => $opt_dir . '/assets/img/widget4.png',
                                'title' => '1/3 + 2/3'
                            ),
                            'two_d' => array(
                                'alt' => '2 Columns',
                                'img' => $opt_dir . '/assets/img/widget5.png',
                                'title' => '3/4 + 1/4'
                            ),
                            'two_e' => array(
                                'alt' => '2 Columns',
                                'img' => $opt_dir . '/assets/img/widget6.png',
                                'title' => '1/4 + 3/4'
                            ),
                            'three' => array(
                                'alt' => '3 Columns',
                                'img' => $opt_dir . '/assets/img/widget7.png',
                                'title' => '1/3 + 1/3 + 1/3'
                            ),
                            'three_b' => array(
                                'alt' => '3 Columns',
                                'img' => $opt_dir . '/assets/img/widget8.png',
                                'title' => '1/4 + 1/2 + 1/4'
                            ),
                            'four' => array(
                                'alt' => '4 Columns',
                                'img' => $opt_dir . '/assets/img/widget9.png',
                                'title' => '1/4 + 1/4 + 1/4 + 1/4'
                            ),
                            'four_b' => array(
                                'alt' => '4 Columns',
                                'img' => $opt_dir . '/assets/img/widget10.png',
                                'title' => '1/6 + 1/6 + 1/6 + 1/2'
                            ),
                            'six' => array(
                                'alt' => '6 Columns',
                                'img' => $opt_dir . '/assets/img/widget11.png',
                                'title' => '1/6*6'
                            ),
                        ),
                        'default' => 'four'
                    ),
                    array(
                        'id'       => 'avi-footer-bottom',
                        'type'     => 'image_select',
                        'title'    => __( 'Footer Bottom Area', 'avi' ),
                        'subtitle' => __( '', 'avi' ),
                        'class'    => 'avi-header-layout ',
                        'options'  => array(
                            '1' => array(
                                'alt' => 'Footer Layout 1',
                                'img'   => $opt_dir . '/assets/img/footer1.png'
                            ),
                            '2' => array(
                                'alt' => 'Footer Layout 2',
                                'img'   => $opt_dir . '/assets/img/footer2.png'
                            ),
                            'none' => array(
                                'alt' => 'Disabled',
                                'img'   => $opt_dir . '/assets/img/footer3.png'
                            )
                        ),
                        'default' => '2'
                    ),      
                        array(
                            'id'       => 'avi-upperleft-element',
                            'type'     => 'select',
                            'title'    => __( 'Upper Left Element', 'avi' ),
                            'subtitle' => __( '', 'avi' ),
                            'options'  => array(
                                'logo' => 'Logo',
                                'link' => 'Footer Links',
                                'copyright' => 'Copyright Text',
                                'social' => 'Social Media Buttons',
                                'contact' => 'Phone and Email',
                                'html' => 'Custom HTML',
                                'none' => 'None'
                            ),
                            'default' => '',
                            'required' => array('avi-footer-bottom', '=', '1')
                        ),
                            array(
                                'id'          => 'avi-upperleft-element-html',
                                'type'        => 'textarea',
                                'title'       => __( 'Custom html for upper left element', 'avi' ),
                                'default'     => '',
                                'required' => array('avi-upperleft-element', '=', 'html')
                            ),                        
                        array(
                            'id'       => 'avi-bottomleft-element',
                            'type'     => 'select',
                            'title'    => __( 'Bottom Left Element', 'avi' ),
                            'subtitle' => __( '', 'avi' ),
                            'options'  => array(
                                'logo' => 'Logo',
                                'link' => 'Footer Links',
                                'copyright' => 'Copyright Text',
                                'social' => 'Social Media Buttons',
                                'contact' => 'Phone and Email',
                                'html' => 'Custom HTML',
                                'none' => 'None'
                            ),
                            'default' => '',
                            'required' => array('avi-footer-bottom', '=', '1')
                        ),       
                            array(
                                'id'          => 'avi-bottomleft-element-html',
                                'type'        => 'textarea',
                                'title'       => __( 'Custom html for bottom left element', 'avi' ),
                                'default'     => '',
                                'required' => array('avi-bottomleft-element', '=', 'html')
                            ),
                        array(
                            'id'       => 'avi-upperright-element',
                            'type'     => 'select',
                            'title'    => __( 'Upper Right Element', 'avi' ),
                            'subtitle' => __( '', 'avi' ),
                            'options'  => array(
                                'logo' => 'Logo',
                                'link' => 'Footer Links',
                                'copyright' => 'Copyright Text',
                                'social' => 'Social Media Buttons',
                                'contact' => 'Phone and Email',
                                'html' => 'Custom HTML',
                                'none' => 'None'
                            ),
                            'default' => '',
                            'required' => array('avi-footer-bottom', '=', '1')
                        ),
                            array(
                                'id'          => 'avi-upperright-element-html',
                                'type'        => 'textarea',
                                'title'       => __( 'Custom html for upper right element', 'avi' ),
                                'default'     => '',
                                'required' => array('avi-upperright-element', '=', 'html')
                            ),
                        array(
                            'id'       => 'avi-bottomright-element',
                            'type'     => 'select',
                            'title'    => __( 'Bottom Right Element', 'avi' ),
                            'subtitle' => __( '', 'avi' ),
                            'options'  => array(
                                'logo' => 'Logo',
                                'link' => 'Footer Links',
                                'copyright' => 'Copyright Text',
                                'social' => 'Social Media Buttons',
                                'contact' => 'Phone and Email',
                                'html' => 'Custom HTML',
                                'none' => 'None'
                            ),
                            'default' => '',
                            'required' => array('avi-footer-bottom', '=', '1')
                        ),
                            array(
                                'id'          => 'avi-bottomright-element-html',
                                'type'        => 'textarea',
                                'title'       => __( 'Custom html for bottom right element', 'avi' ),
                                'default'     => '',
                                'required' => array('avi-bottomright-element', '=', 'html')
                            ),
                        array(
                            'id'       => 'avi-uppercenter-element',
                            'type'     => 'select',
                            'title'    => __( 'Upper Center Element', 'avi' ),
                            'subtitle' => __( '', 'avi' ),
                            'options'  => array(
                                'logo' => 'Logo',
                                'link' => 'Footer Links',
                                'copyright' => 'Copyright Text',
                                'social' => 'Social Media Buttons',
                                'contact' => 'Phone and Email',
                                'html' => 'Custom HTML',
                                'none' => 'None'
                            ),
                            'default' => 'copyright',
                            'required' => array('avi-footer-bottom', '=', '2')
                        ),
                            array(
                                'id'          => 'avi-uppercenter-element-html',
                                'type'        => 'textarea',
                                'title'       => __( 'Custom html for upper center element', 'avi' ),
                                'default'     => '',
                                'required' => array('avi-uppercenter-element', '=', 'html')
                            ),
                        array(
                            'id'       => 'avi-bottomcenter-element',
                            'type'     => 'select',
                            'title'    => __( 'Bottom Center Element', 'avi' ),
                            'subtitle' => __( '', 'avi' ),
                            'options'  => array(
                                'logo' => 'Logo',
                                'link' => 'Footer Links',
                                'copyright' => 'Copyright Text',
                                'social' => 'Social Media Buttons',
                                'contact' => 'Phone and Email',
                                'html' => 'Custom HTML',
                                'none' => 'None'
                            ),
                            'default' => '',
                            'required' => array('avi-footer-bottom', '=', '2')
                        ),
                            array(
                                'id'          => 'avi-bottomcenter-element-html',
                                'type'        => 'textarea',
                                'title'       => __( 'Custom html for bottom center element', 'avi' ),
                                'default'     => '',
                                'required' => array('avi-bottomcenter-element', '=', 'html')
                            ),                        
                        array(
                            'id'       => 'avi-footer-logo',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Footer Logo', 'avi' ),
                            'compiler' => 'true',
                            'subtitle' => __( '', 'avi' ),                
                            'default'  => '',
                            'required' => array('avi-footer-bottom', '!=', 'none')
                        ),        
                        array(
                            'id'       => 'avi-footer-phone',
                            'type'     => 'text',
                            'title'    => __( 'Phone', 'avi' ),
                            'default'  => '',
                            'required' => array('avi-footer-bottom', '!=', 'none'),
                        ),
                        array(
                            'id'       => 'avi-footer-email',
                            'type'     => 'text',
                            'title'    => __( 'Email', 'avi' ),
                            'default'  => '',
                            'required' => array('avi-footer-bottom', '!=', 'none'),
                        ),          
                        array(
                            'id'          => 'avi-footer-copyright',
                            'type'        => 'textarea',
                            'title'       => __( 'Copyright Text', 'avi' ),
                            'subtitle'    => __( 'Use {Y} shortcode to display the current year.', 'avi' ),
                            'default'     => 'Copyrights © '. date('Y') .' All Rights Reserved by Avi.',
                            'required' => array('avi-footer-bottom', '!=', 'none')
                        )
                )     
            )
    );    

    $section[2]['fields'][4]['options']['login'] = __('Login', 'avi');    

    return $section;
}