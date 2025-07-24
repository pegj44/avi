<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Echo html attributes.
 *
 * @since  1.0
 * @param  array     Array of attribute values.
 * @param  string    Attribute name.
 * @return void
 */
function avi_html_attr($val = array(), $attr = 'class') {

    if( is_array($val) ) {

        $val  = array_filter($val);
        if( empty($val) ) { return false; }    

        $glue = ( $attr === 'style' )? '; ' : ' ';
        echo $attr .'="'. implode($glue , array_filter($val)) .'"';
    } else {

        if( trim($val) === '' ) { return false; }
        echo $attr. '="'. $val .'"';
    }
}

/**
 * Archive grid class
 *
 * @since  1.0
 * @return array
 */
function avi_archive_class() {

    global $option;
    global $avi;

    $sidebars = $avi->template_structure->sidebar;
    $window   = $avi->template_structure->get_window();

    $class   = array();
    $col     = 0;
    $masonry = 0;        

    if( !isset( $option['avi-'. $window .'-num-col'] ) ) { return false; }

    $col     = $option['avi-'. $window .'-num-col'];        
    $masonry = isset($option['avi-masonry'][$window])? (int) $option['avi-masonry'][$window] : 0;

    if( $masonry && $col > 1 || $col == 5 ) {
        $class[] = 'post-masonry';
    }

    if( $col > 1 ) {
        $class[] = 'post-grid';
        $class[] = 'avi-post-grid';
        $class[] = 'clearfix';
    }
    
    $grid[0] = '';
    $grid['1'] = '';
    $grid['2'] = 'grid-2';
    $grid['3'] = 'grid-3';
    $grid['4'] = 'grid-4';
    $grid['left'] = 'small-thumbs';
    $grid['right'] = 'small-thumbs alt';
    $grid['alternate'] = 'small-thumbs alternate';
    $grid['5'] = 'post-masonry-full';

    if( $sidebars->count == 1 ) {
        $grid['4'] = 'grid-3';
    }

    if( $sidebars->count > 1 ) {
        $grid['3'] = 'grid-2';
        $grid['4'] = 'grid-2';
    }

    $class[] = $grid[$col];

    return $class;
}

/**
 * Get user social media.
 *
 * @since  1.0
 * @return array
 */
function avi_user_social_media() {
    global $option;
    $the_socials = array();
    $socials = Avi_Options_Functions::get_social_media();
    
    foreach ($socials as $value) {
        if( trim($option[$value['id']]) !== '' || !empty($option[$value['id']])) {
            $the_socials[] = array( 
                                'title' => $value['title'],
                                'link'  => $option[$value['id']],
                                'icon'  => $value['icon'],
                                'class' => $value['class']
                            );
        }
    }
    return $the_socials;
}

/**
 * Set post image loop size depending on layout. 
 * This function is only necessary if the image size needs to be adjusted according to layout.
 */
function avi_thumb_loop() {

    global $avi, $option;

    $sidebar = $avi->template_structure->sidebar->count;

    $layout = 'shop';

    if( is_home() ) {
        $layout = 'blog';
    } else {
        $layout = 'archive';
    }

    $layout  = $option['avi-'. $layout .'-num-col'];

    if( $layout == 'left' || $layout == 'right' ) {
        $size = 'thumb-related';
    } elseif( $layout == 1 && !$sidebar ) {
        $size = 'full';
    } elseif( $layout == 1 && $sidebar == 1 ) {
        $size = 'medium-large';
    } else {
        $size = 'thumb-loop';
    }

    return $size;
}    

function avi_allowed_html() {

    $defaultAttr = array(
        'class' => array(),
        'style' => array()
    );

    $htmlTags = array(
        'a' => $defaultAttr,
        'br' => $defaultAttr,
        'em' => $defaultAttr,
        'strong' => $defaultAttr,
        'h1' => $defaultAttr,
        'h2' => $defaultAttr,
        'h3' => $defaultAttr,
        'h4' => $defaultAttr,
        'h5' => $defaultAttr,
        'h6' => $defaultAttr,
        'p' => $defaultAttr,
        'i' => $defaultAttr,
        'div' => $defaultAttr,
        'img' => $defaultAttr,
        'span' => $defaultAttr,
        'ins' => $defaultAttr,
        'del' => $defaultAttr
    );

    $htmlTags['a']['href'] = array();
    $htmlTags['a']['title'] = array();

    $htmlTags['img']['src'] = array();
    $htmlTags['img']['alt'] = array();

    return $htmlTags;
}

function is_avi_woo( $param, $page = '' ) {

    if ( class_exists( 'woocommerce' ) ) {

        $woo['woocommerce'] = is_woocommerce();
        $woo['shop'] = is_shop();
        $woo['product_category'] = is_product_category($page);
        $woo['product_tag'] = is_product_tag($page);
        $woo['product'] = is_product();
        $woo['cart'] = is_cart();
        $woo['checkout'] = is_checkout();
        $woo['account_page'] = is_account_page();
        $woo['wc_endpoint_url'] = is_wc_endpoint_url($page);

        return $woo[$param];
    }

    return false;
}

function avi_inline_css($css, $value, $selector) {

    global $option;

    $style = array();
    foreach ($css as $key => $val) {
        $cssVal = str_replace('!important', '', $value[$key]);        
        if( trim($cssVal) !== '' ) {
            $style[] = $val .':'. $value[$key];
        }        
    }

    if( !empty($style) ) {
        return $selector .'{'. implode(';', $style) .'}';
    }
}