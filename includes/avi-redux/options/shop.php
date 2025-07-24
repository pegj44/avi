<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Shop options
 */
function avi_option_section_shop() {

    $preset  = Avi_Options::$preset;

    $section = array(
        array(
            'title' => __( 'Shop', 'avi' ),
            'id' => 'avi-shop-archive',
            'icon' => 'icon-shop_archive'
        ),
        array(
            'title'      => __( 'Product Archive', 'avi' ),
            'id'         => 'avi-product-archive-section',
            'subsection' => true,
            'desc'       => __( '', 'avi' ),
            'fields'     => array(
                array(
                    'id'          => 'avi-shop-num-posts',
                    'type'        => 'text',
                    'title'       => __( 'Show product at most', 'avi' ),
                    'subtitle'    => __( 'Number of products to be displayed in shop page.', 'avi' ),
                    'placeholder' => '',
                    'validate'    => 'numeric_not_empty',
                    'default'     => '24'
                ),
                array(
                    'id'       => 'avi-shop-excerpt',
                    'type'     => 'switch',
                    'title'    => __( 'Product Excerpt', 'avi' ),
                    'subtitle' => __( 'Show product excerpt in shop page.', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => false
                ),
                array(
                    'id'       => 'avi-shop-result-count',
                    'type'     => 'switch',
                    'title'    => __( 'Result count', 'avi' ),
                    'subtitle' => __( 'Show result count in shop page.', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => true
                ),
                array(
                    'id'       => 'avi-shop-sorting',
                    'type'     => 'switch',
                    'title'    => __( 'Show sorting', 'avi' ),
                    'subtitle' => __( 'Show sorting options in shop page.', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => true
                )
            )
        ),
        array(
            'title' => __( 'Single Product', 'avi' ),
            'id' => 'avi-single-product-section',
            'subsection' => true,
            'desc' => '',
            'fields' => array(
                array(
                    'id'       => 'avi-product-upsells',
                    'type'     => 'switch',
                    'title'    => __( 'Show Upsells', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => true
                ),
                    array(
                       'id' => 'section-start-upsells',
                       'type' => 'section',
                       'title' => '',
                       'subtitle' => '',
                       'indent' => true 
                    ),
                        array(
                            'id'          => 'avi-product-upsells-text',
                            'type'        => 'text',
                            'title'       => __( 'Upsells Text', 'avi' ),
                            'subtitle'    => __( '', 'avi' ),
                            'default'     => __( 'You may also like&hellip;', 'woocommerce' ),
                            'required' => array( 'avi-product-upsells', '=', '1' ),
                        ),
                    array(
                        'id'     => 'section-end-upsells',
                        'type'   => 'section',
                        'indent' => false,
                    ),                        
                array(
                    'id'       => 'avi-product-related',
                    'type'     => 'switch',
                    'title'    => __( 'Show Related Products', 'avi' ),
                    'on'       => 'On',
                    'off'      => 'Off',
                    'default'  => true
                ),
                    array(
                       'id' => 'section-start-related',
                       'type' => 'section',
                       'title' => '',
                       'subtitle' => '',
                       'indent' => true 
                    ),                
                        array(
                            'id'          => 'avi-product-related-text',
                            'type'        => 'text',
                            'title'       => __( 'Related Product Text', 'avi' ),
                            'subtitle'    => __( '', 'avi' ),
                            'default'     => __( 'Related products', 'woocommerce' ),
                            'required' => array( 'avi-product-related', '=', '1' ),
                        ),    
                    array(
                        'id'     => 'section-end-related',
                        'type'   => 'section',
                        'indent' => false,
                    ),                                       
            )
        )

    );

    return $section;
}