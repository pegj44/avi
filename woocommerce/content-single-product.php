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

	global $option;

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div class="single-product">

	<div class="product_image col_two_fifth">

		<!-- Product Single - Gallery
		============================================= -->
		<div class="product-image">
			<?php do_action('avi_product_gallery'); ?>
			<?php woocommerce_show_product_loop_sale_flash(); ?>
		</div><!-- Product Single - Gallery End -->

	</div>

	<div class="product_summary col_three_fifth bottommargin-sm product-desc col_last">

		<?php do_action('avi_title'); ?>

		<div class="clearfix">
			<!-- Product Single - Price
			============================================= -->			
			<?php woocommerce_template_loop_price(); ?>

			<!-- Product Single - Rating
			============================================= -->
			<?php woocommerce_template_loop_rating(); ?>
		</div>

		<div class="clear"></div>
		<div class="line"></div>

		<?php woocommerce_template_single_add_to_cart(); ?>

		<div class="clear"></div>
		<div class="line"></div>

		<?php do_action('avi_product_content_before'); ?>
		<?php the_content(); ?>
		<?php do_action('avi_product_content_after'); ?>

	</div>		

	<div class="woo_tabs col_full nobottommargin">
		<?php woocommerce_output_product_data_tabs(); ?>			
	</div>

	<?php if( $option['avi-product-upsells'] ) : ?>
		<div class="woo_upsells col_full nobottommargin">
			<?php woocommerce_upsell_display(); ?>
		</div>
	<?php endif; ?>

	<?php if( $option['avi-product-related'] ) : ?>
		<div class="woo_related col_full nobottommargin">
			<?php woocommerce_output_related_products(); ?>
		</div>
	<?php endif; ?>
	
</div>