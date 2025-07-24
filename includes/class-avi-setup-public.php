<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme public setup class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Setup_Public {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'general_typo_styling' ) );
		add_filter( 'excerpt_more', array( $this, 'custom_excerpt_more' ) );
		add_filter( 'get_search_form', array( $this, 'custom_search_form' ) );
		add_filter( 'get_the_archive_title', array( $this, 'custom_archive_title' ) );
	}

	/**
	 * Enqueue front-end scripts
	 *
	 * @access public
	 * @since 1.0
	 * @return void	 
	 */
	public function public_enqueue_scripts() {		    

		global $option;

		/**
		 * comp.css includes
		 *
		 * bootstrap
		 * swiper
		 * style
		 * dark
		 * font-icons
		 * animate
		 * magnific-popup
		 * responsive
		 */

		wp_enqueue_style( 'avi-comp', Avi::$template_dir_url . '/assets/css/comp.css' );

		$color_scheme = ( !$option['avi-custom-color-opt'] )? '#'. $option['avi-color-scheme'] : $option['avi-custom-color'];		
		$navbg = ( isset($option['avi-main-header-bg']['background-color']) )? $option['avi-main-header-bg']['background-color'] : '';

		$colors = '::selection { background: '. $color_scheme .'; }

			::-moz-selection { background: '. $color_scheme .'; }

			::-webkit-selection { background: '. $color_scheme .'; }

			a,
			h1 > span:not(.nocolor),
			h2 > span:not(.nocolor),
			h3 > span:not(.nocolor),
			h4 > span:not(.nocolor),
			h5 > span:not(.nocolor),
			h6 > span:not(.nocolor),
			.header-extras li .he-text span,
			#primary-menu ul li:hover > a,
			#primary-menu ul li.current > a,
			#primary-menu div ul li:hover > a,
			#primary-menu div ul li.current > a,
			#primary-menu ul ul li:hover > a,
			#primary-menu ul li .mega-menu-content.style-2 ul.mega-menu-column > li.mega-menu-title > a:hover,
			#top-cart a:hover,
			.top-cart-action span.top-checkout-price,
			.breadcrumb a:hover,
			.portfolio-filter li a:hover,
			.portfolio-desc h3 a:hover,
			.portfolio-overlay a:hover,
			#portfolio-navigation a:hover,
			.entry-title h2 a:hover,
			.entry-meta li a:hover,
			.post-timeline .entry:hover .entry-timeline,
			.post-timeline .entry:hover .timeline-divider,
			.ipost .entry-title h3 a:hover,
			.ipost .entry-title h4 a:hover,
			.spost .entry-title h4 a:hover,
			.mpost .entry-title h4 a:hover,
			.comment-content .comment-author a:hover,
			.product-title h3 a:hover,
			.single-product .product-title h2 a:hover,
			.product-price ins,
			.single-product .product-price,
			.feature-box.fbox-border .fbox-icon i,
			.feature-box.fbox-border .fbox-icon img,
			.feature-box.fbox-plain .fbox-icon i,
			.feature-box.fbox-plain .fbox-icon img,
			.process-steps li.active h5,
			.process-steps li.ui-tabs-active h5,
			.team-title span,
			.pricing-box.best-price .pricing-price,
			.btn-link,
			.pagination > li > a, .pagination > li > span,
			.pagination > li > a:hover,
			.pagination > li > span:hover,
			.pagination > li > a:focus,
			.pagination > li > span:focus,
			.dark .post-timeline .entry:hover .entry-timeline,
			.dark .post-timeline .entry:hover .timeline-divider,
			.clear-rating-active:hover { color: '. $color_scheme .'; }

			.color,
			.top-cart-item-desc a:hover,
			.portfolio-filter.style-3 li.activeFilter a,
			.faqlist li a:hover,
			.tagcloud a:hover,
			.dark .top-cart-item-desc a:hover,
			.iconlist-color li i,
			.dark.overlay-menu #header-wrap:not(.not-dark) #primary-menu > ul > li:hover > a,
			.dark.overlay-menu #header-wrap:not(.not-dark) #primary-menu > ul > li.current > a,
			.overlay-menu #primary-menu.dark > ul > li:hover > a,
			.overlay-menu #primary-menu.dark > ul > li.current > a,
			.nav-tree li:hover > a,
			.nav-tree li.current > a,
			.nav-tree li.active > a { color: '. $color_scheme .' !important; }

			#primary-menu.style-3 > ul > li.current > a,
			#primary-menu.sub-title > ul > li:hover > a,
			#primary-menu.sub-title > ul > li.current > a,
			#primary-menu.sub-title > div > ul > li:hover > a,
			#primary-menu.sub-title > div > ul > li.current > a,
			#top-cart > a > span,
			#page-menu-wrap,
			#page-menu ul ul,
			#page-menu.dots-menu nav li.current a,
			#page-menu.dots-menu nav li div,
			.portfolio-filter li.activeFilter a,
			.portfolio-filter.style-4 li.activeFilter a:after,
			.portfolio-shuffle:hover,
			.entry-link:hover,
			.sale-flash,
			.button:not(.button-white):not(.button-dark):not(.button-border):not(.button-black):not(.button-red):not(.button-teal):not(.button-yellow):not(.button-green):not(.button-brown):not(.button-aqua):not(.button-purple):not(.button-leaf):not(.button-pink):not(.button-blue):not(.button-dirtygreen):not(.button-amber):not(.button-lime),
			.button.button-dark:hover,
			.promo.promo-flat,
			.feature-box .fbox-icon i,
			.feature-box .fbox-icon img,
			.fbox-effect.fbox-dark .fbox-icon i:hover,
			.fbox-effect.fbox-dark:hover .fbox-icon i,
			.fbox-border.fbox-effect.fbox-dark .fbox-icon i:after,
			.i-rounded:hover,
			.i-circled:hover,
			ul.tab-nav.tab-nav2 li.ui-state-active a,
			.testimonial .flex-control-nav li a,
			.skills li .progress,
			.owl-carousel .owl-dots .owl-dot span,
			#gotoTop:hover,
			.dark .button-dark:hover,
			.dark .fbox-effect.fbox-dark .fbox-icon i:hover,
			.dark .fbox-effect.fbox-dark:hover .fbox-icon i,
			.dark .fbox-border.fbox-effect.fbox-dark .fbox-icon i:after,
			.dark .i-rounded:hover,
			.dark .i-circled:hover,
			.dark ul.tab-nav.tab-nav2 li.ui-state-active a,
			.dark .tagcloud a:hover,
			.ei-slider-thumbs li.ei-slider-element,
			.nav-pills > li.active > a,
			.nav-pills > li.active > a:hover,
			.nav-pills > li.active > a:focus,
			.checkbox-style:checked + .checkbox-style-1-label:before,
			.checkbox-style:checked + .checkbox-style-2-label:before,
			.checkbox-style:checked + .checkbox-style-3-label:before,
			.radio-style:checked + .radio-style-3-label:before,
			.irs-bar,
			.irs-from,
			.irs-to,
			.irs-single,
			input.switch-toggle-flat:checked + label,
			input.switch-toggle-flat:checked + label:after,
			input.switch-toggle-round:checked + label:before,
			.bootstrap-switch .bootstrap-switch-handle-on.bootstrap-switch-themecolor,
			.bootstrap-switch .bootstrap-switch-handle-off.bootstrap-switch-themecolor { background-color: '. $color_scheme .'; }

			.bgcolor,
			.button.button-3d:not(.button-white):not(.button-dark):not(.button-border):not(.button-black):not(.button-red):not(.button-teal):not(.button-yellow):not(.button-green):not(.button-brown):not(.button-aqua):not(.button-purple):not(.button-leaf):not(.button-pink):not(.button-blue):not(.button-dirtygreen):not(.button-amber):not(.button-lime):hover,
			.process-steps li.active a,
			.process-steps li.ui-tabs-active a,
			.sidenav > .ui-tabs-active > a,
			.sidenav > .ui-tabs-active > a:hover,
			.owl-carousel .owl-nav [class*=owl-]:hover,
			.pagination > .active > a,
			.pagination > .active > span,
			.pagination > .active > a:hover,
			.pagination > .active > span:hover,
			.pagination > .active > a:focus,
			.pagination > .active > span:focus { background-color: '. $color_scheme .' !important; }

			#primary-menu.style-4 > ul > li:hover > a,
			#primary-menu.style-4 > ul > li.current > a,
			.top-cart-item-image:hover,
			.portfolio-filter.style-3 li.activeFilter a,
			.post-timeline .entry:hover .entry-timeline,
			.post-timeline .entry:hover .timeline-divider,
			.cart-product-thumbnail img:hover,
			.feature-box.fbox-outline .fbox-icon,
			.feature-box.fbox-border .fbox-icon,
			.dark .top-cart-item-image:hover,
			.dark .post-timeline .entry:hover .entry-timeline,
			.dark .post-timeline .entry:hover .timeline-divider,
			.dark .cart-product-thumbnail img:hover,
			.heading-block.border-color:after { border-color: '. $color_scheme .'; }

			.top-links ul ul,
			.top-links ul div.top-link-section,
			#primary-menu ul ul:not(.mega-menu-column),
			#primary-menu ul li .mega-menu-content,
			#primary-menu.style-6 > ul > li > a:after,
			#primary-menu.style-6 > ul > li.current > a:after,
			#top-cart .top-cart-content,
			.fancy-title.title-border-color:before,
			.dark #primary-menu:not(.not-dark) ul ul,
			.dark #primary-menu:not(.not-dark) ul li .mega-menu-content,
			#primary-menu.dark ul ul,
			#primary-menu.dark ul li .mega-menu-content,
			.dark #primary-menu:not(.not-dark) ul li .mega-menu-content.style-2,
			#primary-menu.dark ul li .mega-menu-content.style-2,
			.dark #top-cart .top-cart-content,
			.tabs.tabs-tb ul.tab-nav li.ui-tabs-active a,
			.irs-from:after,
			.irs-single:after,
			.irs-to:after { border-top-color: '. $color_scheme .'; }

			#page-menu.dots-menu nav li div:after,
			.title-block { border-left-color: '. $color_scheme .'; }

			.title-block-right { border-right-color: '. $color_scheme .'; }

			.fancy-title.title-bottom-border h1,
			.fancy-title.title-bottom-border h2,
			.fancy-title.title-bottom-border h3,
			.fancy-title.title-bottom-border h4,
			.fancy-title.title-bottom-border h5,
			.fancy-title.title-bottom-border h6,
			.more-link,
			.tabs.tabs-bb ul.tab-nav li.ui-tabs-active a { border-bottom-color: '. $color_scheme .'; }

			.border-color,
			.process-steps li.active a,
			.process-steps li.ui-tabs-active a,
			.tagcloud a:hover,
			.pagination > .active > a,
			.pagination > .active > span,
			.pagination > .active > a:hover,
			.pagination > .active > span:hover,
			.pagination > .active > a:focus,
			.pagination > .active > span:focus { border-color: '. $color_scheme .' !important; }

			.fbox-effect.fbox-dark .fbox-icon i:after,
			.dark .fbox-effect.fbox-dark .fbox-icon i:after { box-shadow: 0 0 0 2px '. $color_scheme .'; }

			.fbox-border.fbox-effect.fbox-dark .fbox-icon i:hover,
			.fbox-border.fbox-effect.fbox-dark:hover .fbox-icon i,
			.dark .fbox-border.fbox-effect.fbox-dark .fbox-icon i:hover,
			.dark .fbox-border.fbox-effect.fbox-dark:hover .fbox-icon i { box-shadow: 0 0 0 1px '. $color_scheme .'; }


			@media only screen and (max-width: 991px) {

				body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > ul > li:hover a,
				body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > ul > li.current a,
				body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > div > ul > li:hover a,
				body:not(.dark) #header:not(.dark) #header-wrap:not(.dark) #primary-menu > div > ul > li.current a,
				#primary-menu ul ul li:hover > a,
				#primary-menu ul li .mega-menu-content.style-2 > ul > li.mega-menu-title:hover > a,
				#primary-menu ul li .mega-menu-content.style-2 > ul > li.mega-menu-title > a:hover { color: '. $color_scheme .' !important; }

				#page-menu nav { background-color: '. $color_scheme .'; }

			}


			@media only screen and (max-width: 767px) {

				.portfolio-filter li a:hover { color: '. $color_scheme .'; }
			}

			/*----------------------- Custom default -------------------------*/

			@media only screen and (max-width: 991px) {

				#header.dark.transparent-header { background-color: '. $navbg .' }
			}

			.more-link {
				border-bottom-color: '. $color_scheme .';
			}
			.more-link, .more-link:visited {
				color: '. $color_scheme .';
			}			
			.more-link:hover {
				border-bottom-color: '. $color_scheme .';
			}

			#searchform #searchsubmit,
			form.woocommerce-product-search input[type="submit"] {
			    color: #ffffff;
			    background: '. $color_scheme .';
			}
			.swiper-pagination-progress .swiper-pagination-progressbar {
				background: '. $color_scheme .';
			}
			ul.checklist li:before {
				color: '. $color_scheme .';
			}
			input.wpcf7-form-control.wpcf7-submit {
				background: '. $color_scheme .';
			}
			#reviews input#submit,
			.price_slider_wrapper .ui-slider .ui-slider-handle,
			.price_slider_wrapper .ui-slider .ui-slider-range {
				background-color: '. $color_scheme .';
			}';

		$colors = preg_replace("/[\t\r\n\f]*/","",$colors);
		wp_add_inline_style( 'avi-comp', $colors );

		wp_enqueue_style( 'avi-default', Avi::$template_dir_url . '/assets/css/default.css' );			

		wp_enqueue_style( 'avi-main', get_stylesheet_uri() );

		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			  wp_enqueue_script( 'comment-reply' );
		}		

		wp_enqueue_script( 'avi-plugins', Avi::$template_dir_url . '/assets/js/plugins.js', '', Avi::$version, true ); 	

		wp_register_script( 'avi-functions', Avi::$template_dir_url . '/assets/js/functions.js', '', Avi::$version, true );

		$functions_var = array(
			'file_url' => Avi::$template_dir_url,
		);

		wp_localize_script( 'avi-functions', 'avi_function', $functions_var );
		wp_enqueue_script( 'avi-functions' );

		wp_enqueue_script( 'avi-scripts', Avi::$template_dir_url . '/assets/js/scripts.js', array('jquery'), Avi::$version, true );
	
		if( $option['avi-rtl'] ) {
			
			/**
			 * rtl-comp.css includes
			 *
			 * bootstrap-rtl
			 * style-rtl
			 * dark-rtl
			 * font-icons-rtl
			 * responsive-rtl
			 */
			wp_enqueue_style( 'avi-rtl-comp', Avi::$template_dir_url . '/assets/css/rtl-comp.css' );				
		}

	}

	function general_typo_styling() {

		global $option;

		$topMenu = $option['avi-top-menu-color-typo'];
		$subMenu = $option['avi-submenu-color-typo'];

		$css = '<style type="text/css">';
		$css .= avi_inline_css(array('color'), array($topMenu["regular"] .' !important'), '#primary-menu > ul > li > a,#top-search a, #top-cart a, #side-panel-trigger a, #top-account a,#top-search form input, #header input#s::-webkit-input-placeholder');
		$css .= avi_inline_css(array('color'), array($topMenu["regular"]), '#header input#s:-moz-placeholder');
		$css .= avi_inline_css(array('color'), array($topMenu["regular"]), '#header input#s::-moz-placeholder');
		$css .= avi_inline_css(array('color'), array($topMenu["regular"]), '#header input#s:-ms-input-placeholder');
		$css .= avi_inline_css(array('color'), array($topMenu["regular"]), '#header input#s:placeholder');
		$css .= avi_inline_css(array('color'), array($topMenu["hover"] .' !important'), '#primary-menu > ul > li:hover > a');
		$css .= avi_inline_css(array('color'), array($topMenu["active"] .' !important'), '#primary-menu > ul > li.current-menu-item > a, #primary-menu > ul > li.current-menu-parent > a');
		
		$css .= avi_inline_css(array('color'), array($subMenu["regular"] .' !important'), '.dark #primary-menu:not(.not-dark) ul ul li > a, #primary-menu.dark ul ul li > a');
		$css .= avi_inline_css(array('color'), array($subMenu["hover"] .' !important'), '.dark #primary-menu:not(.not-dark) ul ul li:hover > a, #primary-menu.dark ul ul li:hover > a');
		$css .= avi_inline_css(array('color'), array($subMenu["active"] .' !important'), '.dark #primary-menu:not(.not-dark) ul ul li.current-menu-item > a, #primary-menu.dark ul ul li.current-menu-item > a');

		$css .= '</style>';

		echo preg_replace("/[\t\r\n\f]*/","",$css);
	}

	/**
	 * Chang excerpt read more string
	 *
	 * @access public
	 * @since 1.0
	 * @param string
	 * @return string	 
	 */
	public function custom_excerpt_more( $excerpt ) {
		return '...';
	}

	function custom_search_form($form) {

		$form = '<form role="search" method="get" id="searchform" class="nobottommargin" action="'. esc_url( home_url( '/' ) ) .'" _lpchecked="1">
				<div class="input-group input-group-lg">
					<input type="text" id="s" name="s" class="form-control" placeholder="'. __("Search here...", 'avi') .'">
					<span class="input-group-btn">
						<button class="btn" id="searchsubmit" type="submit">'. __("Submit", "avi") .'</button>
					</span>
				</div>
			</form>';		
		
		return $form;
	}

	public function custom_archive_title( $title ) {

		global $option;

		$window = Avi_Template_Structure::$window;

		if( $window === 'blog' ) {
			$blog = $option['avi-blog-pageheader-txt'];
			if( trim($blog) !== '' ) {
				$title = $blog;
			}
		}
		
		if( is_404() ) {
			$title = __('Page not found', 'avi');
		}

		return $title;
	}

} // end class