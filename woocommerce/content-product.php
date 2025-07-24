<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php post_class(); ?>>

	<div class="product-image">
		
		<?php woocommerce_template_loop_product_thumbnail(); ?>		
		<?php woocommerce_show_product_loop_sale_flash(); ?>
		
		<div class="product-overlay">
			<?php woocommerce_template_loop_add_to_cart(); ?>			
			<a href="<?php the_permalink(); ?>" class="item-quick-view"><i class="icon-zoom-in2"></i><span> <?php _e('View', 'avi'); ?></span></a>
		</div>
	</div>
	<div class="product-desc">
		<div class="product-title"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
		
		<?php woocommerce_template_loop_price(); ?>		
		<?php woocommerce_template_loop_rating(); ?>	
			
		<?php do_action('avi_product_excerpt'); ?>
		
	</div>

</li>
