<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
* Miscellaneous options
*/
function avi_option_section_miscellaneous() {

    $preset  = Avi_Options::$preset;
    $opt_dir = Avi_Options::$option_dir_url;    

    $section = array(
        array(
            'title' => __( 'Miscellaneous', 'avi' ),
            'id' => 'avi-miscellaneous-opt',
            'icon' => 'icon-miscellaneous',
        ),
            array(
                'title'  => __( 'Site PreLoader', 'avi' ),
                'id'     => 'avi-siteloader-opt',
                'desc'   => __( '', 'avi' ),
                'subsection' => true,
                'fields' => array(                   
                    array(
                        'id'       => 'avi-siteloader',
                        'type'     => 'switch',
                        'title'    => __( 'Enable Preloader', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => false
                    ),
                    array(
                        'id'       => 'avi-loading-style',
                        'type'     => 'text',
                        'class'    => 'field-modal',
                        'readonly' => true,
                        'title'    => __('Preloader Style', 'avi'),
                        // 'desc' => '<div class="selecprev" data-mod="avi-loading-style">'. $options['avi-loading-style-prev'] .'</div>',
                        'subtitle' => ' 
                            <div id="avi-loading-style" class="field-desc-modal">
                                <div class="icon-line-cross"></div>
                                <h3>Preloader Style</h3>
                                <div class="desc-modal-content preload-style">                                
                                    <div data-value="1" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader1.gif"></div>
                                    <div data-value="2" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader2.gif"></div>
                                    <div data-value="3" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader3.gif"></div>
                                    <div data-value="4" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader4.gif"></div>
                                    <div data-value="5" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader5.gif"></div>
                                    <div data-value="6" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader6.gif"></div>
                                    <div data-value="7" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader7.gif"></div>
                                    <div data-value="8" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader8.gif"></div>
                                    <div data-value="9" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader9.gif"></div>
                                    <div data-value="10" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader10.gif"></div>
                                    <div data-value="11" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader11.gif"></div>
                                    <div data-value="12" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader12.gif"></div>
                                    <div data-value="13" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader13.gif"></div>
                                    <div data-value="14" class="mitem soc-btn"><img src="'. $opt_dir .'/assets/img/loader14.gif"></div>
                                </div>
                                <div class="field-desc-footer">                                
                                    <input type="button" style="float:left;" class="button opt-modal-x" value="Cancel">
                                    <input type="button" style="float:right;" class="button button-primary opt-modal-y" value="Select Style">
                                </div>
                            </div>',
                        'default'  => '',
                        'required' => array('avi-siteloader', '=', 1)
                    ),
                    array(
                        'id'        => 'avi-preload-color',
                        'type'      => 'color',
                        'title'     => 'Preloader Color',
                        'class' => 'colorprev',
                        'transparent' => false,
                        'default' => '',
                        'required' => array('avi-siteloader', '=', 1)
                    ),
                )
            ),
            array(
                'title'            => __( 'Breadcrumbs', 'avi' ),
                'id'               => 'avi-breadcrumbs-opt',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'           => array(
                    array(
                        'id'       => 'avi-bc-separator',
                        'type'     => 'image_select',
                        'title'    => __( 'Separator', 'avi' ),
                        'options'  => array(
                                'breadcrumb-sep' => array(
                                    'alt'   => 'breadcrumb-sep',
                                    'img'   => $opt_dir . '/assets/img/separator_1.png',
                                ),
                                'icon-line-arrow-right' => array(
                                    'alt'   => 'icon-line-arrow-right',
                                    'img'   => $opt_dir . '/assets/img/separator_2.gif',
                                ),
                                'icon-arrow-right' => array(
                                    'alt'   => 'icon-arrow-right',
                                    'img'   => $opt_dir . '/assets/img/separator_3.gif',
                                ),
                                'icon-chevron-right' => array(
                                    'alt'   => 'icon-chevron-right',
                                    'img'   => $opt_dir . '/assets/img/separator_4.gif',
                                ),
                                'icon-caret-right' => array(
                                    'alt'   => 'icon-caret-right',
                                    'img'   => $opt_dir . '/assets/img/separator_5.gif',
                                ),
                                'icon-angle-right' => array(
                                    'alt'   => 'icon-angle-right',
                                    'img'   => $opt_dir . '/assets/img/separator_6.gif',
                                ),
                                'icon-double-angle-right' => array(
                                    'alt'   => 'icon-double-angle-right',
                                    'img'   => $opt_dir . '/assets/img/separator_7.gif',
                                ),
                                'icon-circle-arrow-right' => array(
                                    'alt'   => 'icon-circle-arrow-right',
                                    'img'   => $opt_dir . '/assets/img/separator_8.gif',
                                ),
                                'icon-long-arrow-right' => array(
                                    'alt'   => 'icon-long-arrow-right',
                                    'img'   => $opt_dir . '/assets/img/separator_9.gif',
                                ),
                                'icon-line2-arrow-right' => array(
                                    'alt'   => 'icon-line2-arrow-right',
                                    'img'   => $opt_dir . '/assets/img/separator_10.png',
                                ),
                            ),
                        'default' => 'breadcrumb-sep'
                    ),
                    array(
                        'id'       => 'avi-breadcrumbs',
                        'type'     => 'switch',
                        'title'    => __('Show Breadcrumbs:', 'avi'), 
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => true
                    ),       
                )
            ),
            array(
                'title'  => __( 'Scroll to Top', 'avi' ),
                'id'     => 'avi-scrolltop-opt',
                'desc'   => __( '', 'avi' ),
                'subsection' => true,
                'fields' => array(                   
                    array(
                        'id'       => 'avi-scrolltop',
                        'type'     => 'switch',
                        'title'    => __( 'Scroll to Top Button', 'avi' ),
                        'on'       => 'On',
                        'off'      => 'Off',
                        'default'  => true
                    ),    
                    array(
                        'id' => 'avi-scrolltop-color',
                        'type' => 'color',
                        'title' => 'Scroll to Top Color',
                        'class' => 'colorprev',
                        'output' => array('background' => '#gotoTop'),
                        'default' => '',
                        'transparent' => false,
                    ),            
                )
            )
    );

    return $section;
}