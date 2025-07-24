<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Woocoommerce setup
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Woocommerce {

	static $option;

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		self::$option = Avi_Options::$option_arr;

		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		// general
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );	
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		add_filter( 'post_class', array( $this, 'avi_shop_post_class' ) );
		add_filter( 'woocommerce_show_page_title' , array( $this, 'avi_hide_woo_page_title' ) );				
		add_filter( 'loop_shop_per_page', array( $this, 'avi_shop_product_num' ), 20 );
		add_filter( 'get_the_title', array( $this, 'woo_title' ), 20 );
		add_filter( 'avi_breadcrumbs_arr', array( $this, 'shop_breadcrumb_current' ), 20 );
		add_filter( 'avi_window', array( $this, 'shop_window' ), 20 );

		add_filter( 'avi_display_share_buttons', array( $this, 'disable_share_buttons' ), 20);
		add_filter( 'avi_share_text', array( $this, 'share_text' ), 20 );
		// add_action( "after_switch_theme", array( $this, "avi_update_shop_image_size" ) );

		// archive-product.php
		remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

		if( !self::$option->{'avi-shop-result-count'} ) {
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
		}

		if( !self::$option->{'avi-shop-sorting'} ) {
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		}		

		add_action( 'woocommerce_after_shop_loop', array( $this, 'avi_shop_paginate' ), 10 );
		add_action( 'avi_product_excerpt', array( $this, 'avi_get_product_excerpt' ) );
		add_filter( 'post_thumbnail_size', array( $this, 'archive_product_thumbs' ), 20 );
		add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'add_to_cart_ajax_fix' ), 20 );
		// ---

		// content-product.php
		add_filter( 'woocommerce_sale_flash' , array( $this, 'avi_custom_sale_flash' ) );
		// ---

		// content-single-product.php
		add_action( 'avi_product_gallery', array( $this, 'avi_get_product_gallery' ) );
		add_action( 'avi_product_content_before', array( $this, 'avi_product_social_before' ), 10 );	
		add_action( 'avi_product_content_after', array( $this, 'avi_product_meta' ), 10 );
		add_action( 'avi_product_content_after', array( $this, 'avi_product_social_after' ), 20 );
		// ---

		if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'cart_link_fragment' ) );
		} else {
			add_filter( 'add_to_cart_fragments', array( $this, 'cart_link_fragment' ) );
		}	

		add_filter( 'avi_breadcrumb_main_taxonmy', array( $this, 'breadcrumbs_taxonomy' ) );

		add_action( 'init', array( $this, 'change_post_object_label' ), 999 );
	}

	/**
	 * Update woocommerce default product thumbnial sizes after theme switch.
	 */
	public function avi_update_shop_image_size() {

		$catalog   = array('width' => '440', 'height' => '586', 'crop' => 1);
		$single    = array('width' => '720', 'height' => '960', 'crop' => 1);
		$thumbnail = array('width' => '180', 'height' => '180', 'crop' => 1);

		update_option( 'shop_catalog_image_size',   $catalog,   false );
		update_option( 'shop_single_image_size',    $single,    false );
		update_option( 'shop_thumbnail_image_size', $thumbnail, false );
	}

	public function archive_product_thumbs( $size ) {
		
		if( is_product_category() || is_shop() ) {
			$size = 'shop_catalog';
		}		

		return $size;
	}

	public function shop_breadcrumb_current( $arr ) {

		if( !is_shop() ) { return $arr; }

		$shop = self::$option->{'avi-shop-pageheader-txt'};

		foreach ($arr as $key => $crumb) {
			if( $crumb['name'] === woocommerce_page_title(0) && trim($shop) !== '' ) {
				$arr[$key]['name'] = $shop;
			}
		}

		return $arr;
	}

	/**
	 * Remove ajax_add_to_cart class if ajax add to cart is disabled.
	 */
	public function add_to_cart_ajax_fix($button) {

		$is_ajax = WC_Admin_Settings::get_option( 'woocommerce_enable_ajax_add_to_cart' );

		if( $is_ajax == 'no' ) {
			$button = preg_replace('/ajax_add_to_cart/', '', $button);
		}		
		return $button;
	}

	/**
	 * Set archive product window as shop.
	 */
	public function shop_window( $window ) {
		
		if( is_product_category() || is_cart() || is_checkout() ) {
			$window = 'shop';
		}		

		return $window;
	}

	public function disable_share_buttons() {

		if( is_cart() || is_checkout() || is_account_page() ) {
			return false;	
		}	

		return true;	
	}

	public function share_text( $text ) {

		if( is_product() ) {
			$text = preg_replace('/article/i', __('product', 'avi'), $text);
		}
		return $text;
	}

	/* ===============================
	   Loop
	   =============================== */

		/**
		 * Removes the "shop" title on the main shop page
		 */
		public function avi_hide_woo_page_title() {
			return false;	
		}

		public function woo_title( $title ) {

			if( is_product_category() ) {
				$title = woocommerce_page_title(0);				
			}

			if( is_shop() ) {
				$title = woocommerce_page_title(0);	
				$shop = self::$option->{'avi-shop-pageheader-txt'};
				if( trim($shop) !== '' ) {
					$title = $shop;
				}
			}
			
			return $title;
		}

		/**
		 * Add clearfix class to product post_class
		 */
		public function avi_shop_post_class( $classes ) {
			global $product;

			if( $product ) {
				$classes[] = 'clearfix';
			}

			return $classes;
		}

		function avi_custom_sale_flash($html) {

			return str_replace( 'onsale', 'sale-flash', $html );
		}

		public function avi_shop_paginate() {

			do_action('avi_paginate');
		}

		public function avi_get_product_excerpt() {

			if( self::$option->{'avi-shop-excerpt'} ) {
				echo '<p class="product-excerpt">'. wp_trim_words( get_the_excerpt(), 35, '...' ) .'</p>';
			}
		}

	/* ===============================
	   Single
	   =============================== */

		public function avi_get_product_gallery() {
			global $product;

			$img_ids = $product->get_gallery_image_ids();

		?>
			
			<div class="product-img-single fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
				<div class="flexslider">
					<div class="slider-wrap" data-lightbox="gallery">

						<?php if( !empty($img_ids) ) : ?>
							<?php foreach( $img_ids as $id  ) : ?>
								<?php $full  = wp_get_attachment_image_src( $id, 'full' ); ?>
								<?php $large = wp_get_attachment_image_src( $id, 'shop_single' ); ?>
								<?php $thumb = wp_get_attachment_image_src( $id, 'shop_thumbnail' ); ?>
								<div class="slide" data-thumb="<?php echo $thumb[0]; ?>"><a href="<?php echo $full[0]; ?>" title="<?php echo get_the_title($id); ?>" data-lightbox="gallery-item">
									<img src="<?php echo $large[0]; ?>" alt="<?php echo get_the_title($id); ?>"></a>
								</div>					
							<?php endforeach; ?>
						<?php elseif( has_post_thumbnail() ) : ?>
							<div class="slide" data-thumb="">
								<a href="<?php the_post_thumbnail_url('full'); ?>" title="<?php echo get_the_title(); ?>" data-lightbox="gallery-item">
								<?php the_post_thumbnail('shop_single'); ?>
								</a>
							</div>							
						<?php else : ?>
						<?php endif; ?>

					</div>
				</div>
			</div>

		<?php
		}

		public function avi_product_social_before() {
			global $avi;			
			$avi->template_structure->content->avi_share_buttons('before');
		}

		public function avi_product_social_after() {
			global $avi;
			$avi->template_structure->content->avi_share_buttons('after');
		}

		public function avi_product_meta() {
			global $product;

			$meta['sku'] = $product->get_sku();

			$cat_ids = get_the_terms( $product->get_id(), 'product_cat' );
			$meta['category'] = null;

			if( !empty($cat_ids) ) {
				$cats = array();
				foreach ($cat_ids as $cat) {
					$cats[] = $cat->term_id;
				}	
				
				$cat_args = array(
						'show_option_all' => '',
						'echo' => 0,
						'title_li' => '',
						'hierarchical' => false,
						'taxonomy' => 'product_cat',
						'include' => $cats,
					);

				$meta['category'] = str_replace( '</a>', '</a><span class="catpipe">, </span>', wp_list_categories($cat_args));
			}

			$meta['tags'] = wc_get_product_tag_list($product->get_id());

			$item['sku'] = '<span itemprop="productID" class="sku_wrapper">'. __('SKU', 'avi') .': <span class="sku">'. $meta['sku'] .'</span></span>';
			$item['category'] = '<span class="posted_in">'. __('Category', 'avi') .': <ul class="product-cat">'. $meta['category'] .'</ul>.</span>';
			$item['tags'] = '<span class="tagged_as">'. __('Tags', 'avi') .': '. $meta['tags'] .'.</span>';

			$items = array_filter($meta);

			if( !empty($items) ) :
		?>
			<div class="panel panel-default product-meta">
				<div class="panel-body">
					<?php foreach( $items as $key => $val ) : ?>
						<?php echo $item[$key]; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php		
			endif;
		}

	public function cart_link_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		
		echo '<span class="cart-items">'. $woocommerce->cart->cart_contents_count .'</span>';
		$fragments['.cart-items'] = ob_get_clean();

		return $fragments;
	}

	public function breadcrumbs_taxonomy( $tax ) {

		if( get_post_type() === 'product' ) {

			$tax = 'product_cat';
		}

		return $tax;
	}

	public function change_post_object_label() {

	    $label = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
		$obj = get_post_type_object('product');
		$obj->label = $label;
		$obj->labels->name = $label;
	}

	public function avi_shop_product_num($cols) {

		return self::$option->{'avi-shop-num-posts'};
	}

} // end class