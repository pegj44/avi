<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Social media options
 */
function avi_option_section_social_media() {

    $option = Avi_Options::$option_arr;
    $preset = Avi_Options::$preset;

    $section = array(
        array(
            'title' => __( 'Social Media', 'avi' ),
            'id' => 'avi-social-media',
            'desc' => __( 'Include http:// or https://', 'avi' ),
            'icon' => 'icon-social_media',
        ),
            array(
                'title'      => __( 'Share Buttons', 'avi' ),
                'id'         => 'avi-media-share',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                        'id'       => 'avi-share-buttons-in',
                        'type'     => 'checkbox',
                        'title'    => __('Enable Share Buttons In:', 'avi'),
                        'options'  => array(
                            'post' => 'Post',
                            'page' => 'Page',
                            'product' => 'Product',                
                        ),
                        'default'  => array(
                                'post' => '1',
                                'product' => '1'
                            )
                    ),
                    array(
                        'id'       => 'avi-display-socials',
                        'type'     => 'radio',
                        'title'    => __('Display Share Buttons', 'avi'), 
                        'options'  => array(
                            'before' => 'Before Content', 
                            'after' => 'After Content', 
                            'both' => 'Both Before & After',
                            'fleft' => 'Float Left',                        
                        ),
                        'default'  => 'after'
                    ),
                    array(
                        'id'       => 'avi-share-text',
                        'type'     => 'text',
                        'title'    => __( 'Share Text', 'avi' ),
                        'default' => __( 'Share this article', 'avi' )
                    ),        
                    array(
                        'id'      => 'avi-enabled-share-buttons',
                        'type'    => 'sorter',
                        'title'   => 'Select Share Buttons',
                        'subtitle' => 'Drag and drop the social media icons to the left to enable.',
                        'options' => array(
                            'Enabled' => Avi_Options_Functions::get_share_buttons('title'),
                            'Disabled' => array(
                                'placebo' => 'placebo'
                            )
                        ),
                        'default' => array(
                                'Enabled' => array(
                                    'facebook' => 'Facebook',
                                    'twitter' => 'Twitter',
                                    'gplus' => 'Google Plus',
                                    'pinterest' => 'Pinterest'
                                )
                            )
                    ),
                )
            ),
            array(
                'title'      => __( 'Social Media Links', 'avi' ),
                'id'         => 'avi-media-page',
                'desc'       => __( 'Include http:// or https://', 'avi' ),
                'subsection' => true,
                'class'      => 'soc-links',
                'fields'     => Avi_Options_Functions::get_social_media()
            ),
            array(
                'title'      => __( 'Styling', 'avi' ),
                'id'         => 'avi-media-styling',
                'desc'       => __( '', 'avi' ),
                'subsection' => true,
                'fields'     => array(
                    array(
                       'id' => 'section-start-btnstyle1',
                       'type' => 'section',
                       'title' => __('Share Buttons', 'avi'),
                       'indent' => true,
                    ),
                        array(
                            'id'       => 'avi-share-size',
                            'type'     => 'select',
                            'title'    => __('Share Button Size', 'avi'), 
                            'options'  => array(
                                'small' => 'Small', 
                                'medium' => 'Medium', 
                                'large' => 'Large',
                            ),
                            'default'  => 'small'
                        ), 
                        array(
                            'id' => 'avi-share-style-prev',
                            'type' => 'textarea',
                            'class' => 'prevonly',
                            'readonly' => true,
                            'default' => '<div data-value="style9" id="style9" class="mitem soc-btn selected"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>'
                        ),                
                        array(
                            'id'       => 'avi-share-style',
                            'type'     => 'text',
                            'title'    => __('Share Button Style', 'avi'), 
                            'class'    => 'field-modal',
                            'readonly' => true,
                            'desc' => '<div class="selecprev" data-mod="avi-share-style">'. $option->{'avi-share-style-prev'} .'</div>',
                            'subtitle' => '
                                <div id="avi-share-style" class="field-desc-modal">
                                    <div class="icon-line-cross"></div>
                                    <h3>Footer Social Media Button Styles</h3>
                                    <div class="desc-modal-content">                                
                                        <div data-value="style1" id="style1" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style2" id="style2" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style3" id="style3" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style4" id="style4" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style5" id="style5" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style6" id="style6" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style7" id="style7" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style8" id="style8" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style9" id="style9" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                    </div>
                                    <div class="field-desc-footer">                                
                                        <input type="button" style="float:left;" class="button opt-modal-x" value="Cancel">
                                        <input type="button" style="float:right;" class="button button-primary opt-modal-y" value="Select Style">
                                    </div>
                                </div>',
                            'default'  => 'style9'
                        ),
                    array(
                        'id'        => 'avi-share-style-color',
                        'type'      => 'color',
                        'title'     => 'Share Button Color',
                        'class' => 'colorprev color_avi-share-style',
                        'transparent' => false,
                        'default' => ''
                    ),
                    array(
                        'id'     => 'section-end',
                        'type'   => 'section',
                        'indent' => false,                
                    ),        
                    array(
                       'id' => 'section-start-btnstyle2',
                       'type' => 'section',
                       'title' => __('Footer Social Media', 'avi'),
                       'subtitle' => '',
                       'indent' => true,
                    ),
                        array(
                            'id'       => 'avi-footerbtn-size',
                            'type'     => 'select',
                            'title'    => __('Social Button Size', 'avi'), 
                            'options'  => array(
                                'small' => 'Small', 
                                'medium' => 'Medium', 
                                'large' => 'Large',
                            ),
                            'default'  => 'small'
                        ),   
                        array(
                            'id' => 'avi-footerbtn-style-prev',
                            'type' => 'textarea',
                            'class' => 'prevonly',
                            'readonly' => true,
                            'default' => '<div data-value="style9" id="style9" class="mitem soc-btn selected"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>'
                        ),
                        array(
                            'id'       => 'avi-footerbtn-style',
                            'type'     => 'text',
                            'class'    => 'field-modal',
                            'readonly' => true,
                            'title'    => __('Social Button Style', 'avi'),
                            'desc' => '<div class="selecprev" data-mod="avi-footerbtn-style">'. $option->{'avi-footerbtn-style-prev'} .'</div>',
                            'subtitle' => ' 
                                <div id="avi-footerbtn-style" class="field-desc-modal">
                                    <div class="icon-line-cross"></div>
                                    <h3>Footer Social Media Button Styles</h3>
                                    <div class="desc-modal-content">                                
                                        <div data-value="style1" id="style1" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style2" id="style2" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style3" id="style3" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style4" id="style4" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style5" id="style5" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style6" id="style6" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style7" id="style7" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style8" id="style8" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                        <div data-value="style9" id="style9" class="mitem soc-btn"><span class="icon-facebook"></span><span class="icon-google-plus"></span><span class="icon-stumbleupon"></span><span class="icon-digg"></span><span class="icon-reddit"></span><span class="icon-dribbble"></span><span class="icon-linkedin"></span><span class="icon-vk"></span><span class="icon-twitter"></span><span class="icon-tumblr"></span></div>
                                    </div>
                                    <div class="field-desc-footer">                                
                                        <input type="button" style="float:left;" class="button opt-modal-x" value="Cancel">
                                        <input type="button" style="float:right;" class="button button-primary opt-modal-y" value="Select Style">
                                    </div>
                                </div>',
                            'default'  => 'style9'  
                        ),
                        array(
                            'id'        => 'avi-footerbtn-style-color',
                            'type'      => 'color',
                            'title'     => 'Footer Social Button Color',
                            'class' => 'colorprev',
                            'transparent' => false,
                            'default' => ''
                        ),
                    array(
                        'id'     => 'section-end',
                        'type'   => 'section',
                        'indent' => false,                
                    ), 
                )
            )
    );

    return $section;
}