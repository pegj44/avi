<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

    global $option;
    global $avi;

    $GLOBALS['woocommerce_loop']['loop'] = 0;	       

    $class['2'] = 'product-2';
    $class['3'] = 'product-3';
    $class['4'] = 'product-4';
    $class['left'] = 'product-1';

    $sidebar = $avi->template_structure->sidebar->count;

    if( $sidebar > 1 ) {
        $class['3'] = 'product-2';
        $class['4'] = 'product-2';
    }

    if( $sidebar == 1 ) {
    	$class['4'] = 'product-3';
    }

?>
	        
<div class="clear" ></div><ul id="shop" class="shop <?php echo $class[$option['avi-shop-num-col']] ?> clearfix">