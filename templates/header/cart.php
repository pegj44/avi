<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for menu cart
 *
 * @package avi
 */

	global $woocommerce;
?>

<div id="top-cart">
	<a href="#" id="top-cart-trigger"><i class="icon-shopping-cart"></i>
		<span class="cart-items"><?php echo $woocommerce->cart->cart_contents_count; ?></span>		
	</a>
	<div class="top-cart-content-wrap">
  		<div class="top-cart-content">
			<div class="top-cart-title">
				<h4><?php _e( 'Shopping Cart', 'avi' ); ?></h4>
			</div>
			<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		</div>
	</div>
</div>