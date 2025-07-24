<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Theme template header class
 * 
 * @package avi
 * @version 1.0.0
 */
class Avi_Template_Header extends Avi_Template_Structure {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	public function __construct() {		

		add_action( 'avi_header', array( $this, 'avi_top_bar' ), 10 );
		add_action( 'avi_header', array( $this, 'avi_get_top_slider' ), 20 );
		add_action( 'avi_header', array( $this, 'avi_main_header' ), 30 );
		add_action( 'avi_header', array( $this, 'avi_get_bottom_slider' ), 40 );

		add_action( 'avi_nav_elements', array( $this, 'nav_cart' ), 10 );
		add_action( 'avi_nav_elements', array( $this, 'nav_search' ), 20 );
		add_action( 'avi_topbar_item', array( $this, 'avi_topbar_item' ), 10, 1 );

		add_action( 'wp_footer', array( $this, 'avi_slider_script' ), 999 );
	}	

    /**
     * Display top header left/right area elements
	 *
  	 * @access public
	 * @since  1.0
  	 * @param  string
  	 * @param  string
  	 * @param  string	 
	 * @return void	 
	 */
    public function avi_topbar_item($position = 'left') {

        $el = $this->option('avi-top-'. $position);

        if( $el !== '' ) {

            $arr = array(
                    'top-menu' => 'top-links',
                    'social-icons' => 'top-socials',
                    'phone-email' => 'top-contact',
                    'login' => '',
                );

		    if ( class_exists( 'WooCommerce' ) ) {
		        $arr['login'] = 'top-login';
		    }            

            if( $el !== 'custom-html' ) {
                $this->avi_template('header/'. $arr[$el]); 
            } else {
                echo $this->option('avi-top'. $position .'-html');
            }           
        }       
    }

	/**
	 * Display top header area
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function avi_top_bar() {

		if( $this->option('avi-top-header') ) {
			$data['width'] = ( $this->option('avi-header-width') )? 'full-header' : '';
			$data['dark'] = ( $this->option('avi-top-header-dark') )? 'dark' : '';
			$this->avi_template('header/nav_top', $data);
		}
	}

	/**
	 * Display primary header navigation area	 
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function avi_main_header() {

		$logo   = $this->option('avi-logo')->{'url'};
		$retina = $this->option('avi-logo-retina')->{'url'};

		$data = array(
			'logo'    	   => ( $retina && !$logo )? $retina : (($logo)? $logo : ''),
			'retina'   	   => ( $retina )? $retina : $logo,
			'sticky_logo'  => ( $this->option('avi-alternate-logo') )? 'data-sticky-logo="'. esc_url( $this->option('avi-alt-standard-logo')->{'url'} ) .'" ' : '',
			'mobile_logo'  => ( $this->option('avi-mobile-logo')->{'url'} )? 'data-mobile-logo="'. esc_url( $this->option('avi-mobile-logo')->{'url'} ) .'"' : '',
		);

		$class = array(		
			'nav-extra' => ( $this->option('avi-header-search') || $this->option('avi-header-cart') ),
			'full-header' => ( $this->option('avi-header-width') ),
			'no-sticky' => ( !$this->option('avi-sticky-header') ),
			'dark' => ( $this->option('avi-main-header-dark') )
		);

		$class = array_filter($class);
		$data['class'] = array_keys($class);
		$data['class'][] = $this->option('avi-header-layout');

		if( is_singular() && get_field('avi_slider') && get_field('avi_transparent_header') ) {
			$data['class'][] = 'transparent-header';
		}

		$this->avi_template('header/'. $this->option('avi-header-layout'), $data);
	}

	/**
	 * cart menu
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function nav_cart() {
		global $option;
		
		if ( $option['avi-header-cart'] && class_exists('woocommerce') ) {
			$this->avi_template('header/cart');
		}
	}

	/**
	 * site header navigation search field
	 *
  	 * @access public
	 * @since  1.0 
	 * @return void	 
	 */
	public function nav_search() {
		global $option;

		if( $option['avi-header-search'] ) {
			$this->avi_template('header/search');
		}
	}

	public function avi_get_top_slider() {
	    $this->avi_get_page_slider('before');
	}

	public function avi_get_bottom_slider() {
	    $this->avi_get_page_slider('after');
	}

	public function avi_get_page_slider($pos) {

	    if ( !get_field('avi_slider') || get_field('avi_slider_position') !== $pos || !is_singular() ) { return false; }

	    $this->avi_template('content/asides/swiper-slider');
	}

	public function avi_slider_script() {

		global $post;

		$taxonomy = 'avi_slider';
		$term_id = get_field('avi_slider');	

		// $multirow = get_field( 'avi_slider_multi_row', $taxonomy .'_'. $term_id );
		// $slidesPerColumn = get_field( 'avi_slider_slides_per_column', $taxonomy .'_'. $term_id );
		// $slidesPerRow = get_field( 'avi_slider_slides_per_view', $taxonomy .'_'. $term_id );
		// $slidestoShow = get_field( 'avli_slider_slides_to_show', $taxonomy .'_'. $term_id );
		$canSwipe = get_field( 'avi_slider_swipe', $taxonomy .'_'. $term_id );
		$canSwipe = ( $canSwipe )? null : 'swiper-no-swiping';
		$pagiType = get_field( 'avi_slider_pagination', $taxonomy .'_'. $term_id );
		$sHeight  = get_field( 'avi_slider_height', $taxonomy .'_'. $term_id );
		$parallax = get_field( 'avi_slider_parallax', $taxonomy .'_'. $term_id );
		$isLoop = get_field( 'avi_slider_loop', $taxonomy .'_'. $term_id );
		// $pagiType = ( $pagiType === 'none' || $pagiType === 'thumbnail' )? 'false' : $pagiType;
		// $pagiType = 'progress';
		// var_dump($pagiType);
		// $slidesPerView = $slidestoShow;
		// $slidesPerCol = 1;

		// if( $multirow ) {
		// 	$slidesPerCol = $slidesPerColumn;
			// $slidesPerView = $slidesPerRow;
		// }

		// if( !is_singular() || !get_field('avi_slider', $post->ID) ) { return false; }		
?>

		<script type="text/javascript">

			var SEMICOLON,
				swiperSlider = '',
				$slider = $('#slider');
				// $sliderThumb = $('');

			SEMICOLON.slider.sliderRun = function(){

			if( typeof Swiper === 'undefined' ) {
				console.log('sliderRun: Swiper not Defined.');
				return true;
			}

			if( $slider.hasClass('swiper_wrapper') ) {

				var element = $slider.filter('.swiper_wrapper'),
					elementDirection = element.attr('data-direction'),
					elementSpeed = element.attr('data-speed'),
					elementAutoPlay = element.attr('data-autoplay'),
					elementLoop = element.attr('data-loop'),
					elementEffect = element.attr('data-effect'),
					elementGrabCursor = element.attr('data-grab'),
					slideNumberTotal = element.find('#slide-number-total'),
					slideNumberCurrent = element.find('#slide-number-current'),
					sliderVideoAutoPlay = element.attr('data-video-autoplay');

				if( !elementSpeed ) { elementSpeed = 300; }
				if( !elementDirection ) { elementDirection = 'horizontal'; }
				if( elementAutoPlay ) { elementAutoPlay = Number( elementAutoPlay ); }
				if( elementLoop == 'true' ) { elementLoop = true; } else { elementLoop = false; }
				if( !elementEffect ) { elementEffect = 'slide'; }
				if( elementGrabCursor == 'false' ) { elementGrabCursor = false; } else { elementGrabCursor = true; }
				if( sliderVideoAutoPlay == 'false' ) { sliderVideoAutoPlay = false; } else { sliderVideoAutoPlay = true; }


				if( element.find('.swiper-pagination').length > 0 ) {
					var elementPagination = '.swiper-pagination',
						elementPaginationClickable = true,
						elementPaginationType = $(elementPagination).attr('data-pagi-type');
				} else {
					var elementPagination = '',
						elementPaginationClickable = false,
						elementPaginationType = 'false';
				}

				var elementNavNext = '#slider-arrow-right',
					elementNavPrev = '#slider-arrow-left';

				swiperSlider = new Swiper( element.find('.swiper-parent') ,{
					direction: elementDirection,
					speed: Number( elementSpeed ),
					autoplay: elementAutoPlay,
					loop: elementLoop,
					// height : 300,
					effect: elementEffect,
					noSwipingClass : 'swiper-no-swiping',
					grabCursor: elementGrabCursor,
					<?php if($isLoop) : ?>
					loopedSlides: $(".swiper-parent .swiper-wrapper .swiper-slide").length,
					<?php endif; ?>
					pagination: elementPagination,
					paginationType: elementPaginationType,
					paginationClickable: elementPaginationClickable,
					prevButton: elementNavPrev,
					nextButton: elementNavNext,
					onInit: function(swiper){
						SEMICOLON.slider.sliderParallaxDimensions();
						element.find('.yt-bg-player').removeClass('customjs');
						SEMICOLON.widget.youtubeBgVideo();
						$('.swiper-slide-active [data-caption-animate]').each(function(){
							var $toAnimateElement = $(this),
								toAnimateDelay = $toAnimateElement.attr('data-caption-delay'),
								toAnimateDelayTime = 0;
							if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 750; } else { toAnimateDelayTime = 750; }
							if( !$toAnimateElement.hasClass('animated') ) {
								$toAnimateElement.addClass('not-animated');
								var elementAnimation = $toAnimateElement.attr('data-caption-animate');
								setTimeout(function() {
									$toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
								}, toAnimateDelayTime);
							}
						});
						$('[data-caption-animate]').each(function(){
							var $toAnimateElement = $(this),
								elementAnimation = $toAnimateElement.attr('data-caption-animate');
							if( $toAnimateElement.parents('.swiper-slide').hasClass('swiper-slide-active') ) { return true; }
							$toAnimateElement.removeClass('animated').removeClass(elementAnimation).addClass('not-animated');
						});
						SEMICOLON.slider.swiperSliderMenu();
					},
					onSlideChangeStart: function(swiper){
						if( slideNumberCurrent.length > 0 ){
							if( elementLoop == true ) {
								slideNumberCurrent.html( Number( element.find('.swiper-slide.swiper-slide-active').attr('data-swiper-slide-index') ) + 1 );
							} else {
								slideNumberCurrent.html( swiperSlider.activeIndex + 1 );
							}
						}
						$('[data-caption-animate]').each(function(){
							var $toAnimateElement = $(this),
								elementAnimation = $toAnimateElement.attr('data-caption-animate');
							if( $toAnimateElement.parents('.swiper-slide').hasClass('swiper-slide-active') ) { return true; }
							$toAnimateElement.removeClass('animated').removeClass(elementAnimation).addClass('not-animated');
						});
						SEMICOLON.slider.swiperSliderMenu();
					},
					onSlideChangeEnd: function(swiper){
						element.find('.swiper-slide').each(function(){
							var slideEl = $(this);
							if( slideEl.find('video').length > 0 && sliderVideoAutoPlay == true ) { slideEl.find('video').get(0).pause(); }
							if( slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').length > 0 ) { slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').YTPPause(); }
						});
						element.find('.swiper-slide:not(".swiper-slide-active")').each(function(){
							var slideEl = $(this);
							if( slideEl.find('video').length > 0 ) {
								if( slideEl.find('video').get(0).currentTime != 0 ) { slideEl.find('video').get(0).currentTime = 0; }
							}
							if( slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').length > 0 ) {
								slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').YTPGetPlayer().seekTo( slideEl.find('.yt-bg-player.mb_YTPlayer:not(.customjs)').attr('data-start') );
							}
						});
						if( element.find('.swiper-slide.swiper-slide-active').find('video').length > 0 && sliderVideoAutoPlay == true ) { element.find('.swiper-slide.swiper-slide-active').find('video').get(0).play(); }
						if( element.find('.swiper-slide.swiper-slide-active').find('.yt-bg-player.mb_YTPlayer:not(.customjs)').length > 0 && sliderVideoAutoPlay == true ) { element.find('.swiper-slide.swiper-slide-active').find('.yt-bg-player.mb_YTPlayer:not(.customjs)').YTPPlay(); }

						element.find('.swiper-slide.swiper-slide-active [data-caption-animate]').each(function(){
							var $toAnimateElement = $(this),
								toAnimateDelay = $toAnimateElement.attr('data-caption-delay'),
								toAnimateDelayTime = 0;
							if( toAnimateDelay ) { toAnimateDelayTime = Number( toAnimateDelay ) + 300; } else { toAnimateDelayTime = 300; }
							if( !$toAnimateElement.hasClass('animated') ) {
								$toAnimateElement.addClass('not-animated');
								var elementAnimation = $toAnimateElement.attr('data-caption-animate');
								setTimeout(function() {
									$toAnimateElement.removeClass('not-animated').addClass( elementAnimation + ' animated');
								}, toAnimateDelayTime);
							}
						});
					}
				});				

				if( slideNumberCurrent.length > 0 ) {
					if( elementLoop == true ) {
						slideNumberCurrent.html( Number( element.find('.swiper-slide.swiper-slide-active').attr('data-swiper-slide-index') ) + 1 );
					} else {
						slideNumberCurrent.html( swiperSlider.activeIndex + 1 );
					}
				}
				if( slideNumberTotal.length > 0 ) {
					slideNumberTotal.html( element.find('.swiper-slide:not(.swiper-slide-duplicate)').length );
				}

			}

			<?php if( $pagiType === 'thumbnail' ) : ?>

				var sliderHeight = $('#slider').outerHeight();

				<?php if($parallax) : ?>
					<?php if( $sHeight === 'full' ) : ?>
						$('#slider').height(sliderHeight);
						sliderHeight = sliderHeight - 110;
						$('#slider .slider-parallax-inner').height(sliderHeight);
					<?php else : ?>
						$('#slider').height(sliderHeight + 110);
					<?php endif; ?>
				<?php else : ?>
					$('#slider').height('auto');
				<?php endif; ?>

				$('#slider .swiper-slide').height(sliderHeight);

			    var galleryThumbs = new Swiper('.gallery-thumbs', {
			        spaceBetween: 5,
			        centeredSlides: true,
			        slidesPerView: 'auto',
			        touchRatio: 0.3,
			        loop: elementLoop,
			        slideToClickedSlide: true,
			        grabCursor: true
			    });

				swiperSlider.params.control = galleryThumbs;
				galleryThumbs.params.control = swiperSlider;

			<?php endif; ?>

		}
		
		</script>	

<?php
	}

} // end class