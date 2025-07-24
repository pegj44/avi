<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template swiper slider
 *
 * @package avi
 */

	global $post;
	
	$taxonomy = 'avi_slider';
	$term_id = get_field('avi_slider');	

	$args = array(
		'post_type' => 'avi_slide', 
		'posts_per_page' => -1, 
		'tax_query' => array(
			array(
				'taxonomy' => $taxonomy,
				'field' => 'id',
				'terms' => $term_id
			)
		)
	);

	$loop = new WP_Query( $args );

	$parallax = get_field( 'avi_slider_parallax', $taxonomy .'_'. $term_id );
	$sHeight  = get_field( 'avi_slider_height', $taxonomy .'_'. $term_id );
	$height  = get_field( 'avi_slide_height', $taxonomy .'_'. $term_id );
	// $slidestoShow = get_field( 'avli_slider_slides_to_show', $taxonomy .'_'. $term_id );
	$autoplay = get_field( 'avi_slider_autoplay', $taxonomy .'_'. $term_id );
	$animateSpeed = get_field( 'avi_slider_animation_speed', $taxonomy .'_'. $term_id );
	$playSpeed = get_field( 'avi_slider_autoplay_speed', $taxonomy .'_'. $term_id );
	$autoplay = ( $autoplay )? $playSpeed : '';
	$effect = get_field( 'avi_slider_slide_animation_type', $taxonomy .'_'. $term_id );
	$hasArrow = get_field( 'avi_slider_show_arrow', $taxonomy .'_'. $term_id );
	$pagiType = get_field( 'avi_slider_pagination', $taxonomy .'_'. $term_id );
	$pagination = ( $pagiType !== 'none' && $pagiType !== 'thumbnail' )? $pagiType : 'false';

	$pagiThumbs = array();

	$isLoop = get_field( 'avi_slider_loop', $taxonomy .'_'. $term_id );
	$isLoop = ( $isLoop )? 'true' : 'false';

	$slider_class[] = 'swiper_wrapper';
	$slider_class[] = 'customjs';
	$slider_class[] = 'clearfix';

	if( $sHeight === 'full' ) {
		$slider_class[] = 'full-screen';	
	}
	if( $parallax ) {
		$slider_class[] = 'slider-parallax';	
	}
	// if( $slidestoShow > 1 ) {
	// 	$slider_class[] = 'multi-slide';
	// }

	$slider_style = array();
	if( $sHeight === 'custom' ) {
		$slider_style[] = 'height: '. $height . 'px';	
	}

	$styles = '';

	$galleryTop = ( $pagiType === 'thumbnail' )? 'gallery-top' : '';
?>
	<section id="slider" 
	<?php avi_html_attr( $slider_class ); ?> 
	<?php avi_html_attr( $slider_style, 'style' ); ?>
	<?php avi_html_attr( $isLoop, 'data-loop' ); ?>
	<?php avi_html_attr( $autoplay, 'data-autoplay' ); ?>
	<?php avi_html_attr( $animateSpeed, 'data-speed' ); ?>
	<?php avi_html_attr( $effect, 'data-effect' ); ?> >

		<?php if( $parallax ) : ?>
			<div class="slider-parallax-inner">
		<?php endif; ?>

			<div class="swiper-container swiper-parent <?php echo esc_attr($galleryTop); ?>">
				<div class="swiper-wrapper">

					<?php if( $loop->have_posts() ) : ?>

						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

							<?php
								$type 	= get_field('avi_slide_type');
								$image 	= get_field('avi_slide_image');
								$video 	= get_field('avi_slide_video');
								$vidurl = get_field('avi_slide_video_url');
								$cOverlay = get_field('avi_slide_color_overlay');
								$iOverlay = ( get_field('avi_slide_img_overlay') )? 'overlay-grid' : false;
								$isHtml = get_field('avi_slide_custom_html');
								$position = get_field('avi_slide_content_position');
								$hText = get_field('avi_slide_heading_text');
								$sText = get_field('avi_slide_subtext');
								$html  = get_field('avli_slide_html');
								$isdark = get_field('avi_slide_dark');
								$bg_img = ( $image )? 'style="background-image: url('. esc_url($image['url']) .');"' : '';
								$btn_1 = get_field('avi_slide_button_1');
								$btn_2 = get_field('avi_slide_button_2');
								$canSwipe = get_field( 'avi_slider_swipe', $taxonomy .'_'. $term_id );

								$slide_id = 'slide-item-'. get_the_ID();
								$slide_class = array();
								$slide_class[] = $slide_id;
								$slide_class[] = 'swiper-slide';

								if( !$canSwipe ) {
									$slide_class[] = 'swiper-no-swiping';	
								}
								
								if( !$isdark ) {
									$slide_class[] = 'dark';
								}								

								$cOverlay = ( $cOverlay !== '' )? 'background-color: '.  $cOverlay : false;								

								for ($btnnum=1; $btnnum <= 2; $btnnum++) {

									$btn = get_field('avi_slide_button_'. $btnnum);

									if( $btn['style'] === 'bordered' || $btn['style'] === 'border_rounded' ) {
										$styles .= '.'. $slide_id .' .button-border.avi_slide_button_'. $btnnum .' { border-color: '. $btn['color'] .' !important; color: '. $btn['textcolor'] .' !important; }';
										$styles .= '.'. $slide_id .' .button-border.avi_slide_button_'. $btnnum .':hover { background-color: '. $btn['color'] .' !important; border-color: '. $btn['color'] .' !important; color: '. $btn['textcolor'] .' !important; }';
									} else {
										$styles .= '.'. $slide_id .' .button.avi_slide_button_'. $btnnum .' { background-color: '. $btn['color'] .' !important; color: '. $btn['textcolor'] .' !important; }';	
									}

								}

								if( $image ) {								
									$pagiThumbs[] = array( 'type' => 'image', 'url' => $image['sizes']['thumb-520x280'] );
								}
							?>

							<div <?php avi_html_attr( $slide_class ); ?> <?php echo $bg_img; ?>>
								<?php if( !$isHtml ) : ?>
									<div class="container clearfix">

										<div class="slider-caption slider-caption-<?php echo $position; ?>">

											<?php if( trim( $hText !== '' ) ) : ?>
												<h2><?php echo wp_kses( $hText, array() ); ?></h2>
											<?php endif; ?>
											<?php if( trim( $sText !== '' ) ) : ?>
												<p class="bottommargin-sm"><?php echo wp_kses( $sText, array() ); ?></p>
											<?php endif; ?>
											<?php 
												if( $btn_1['button'] ) {
													echo $btn_1['button'];
												}
												if( $btn_2['button'] ) {
													echo $btn_2['button'];
												}
											?>												
										</div>
									</div>	
								<?php else : ?>
									<?php echo $html; ?>
								<?php endif; ?>

								<?php if( $type === 'video_url' ) : $pagiThumbs[] = array( 'type' => 'video_url', 'url' => $vidurl ); ?>
									<div class="yt-bg-player" data-video="<?php echo esc_url( $vidurl ); ?>"></div>
								<?php endif; ?>

								<?php if( $type === 'video' ) : $pagiThumbs[] = array( 'type' => 'video', 'url' => $video ); ?>
			                        <div class="video-wrap">
			                            <video poster="" preload="auto" loop autoplay muted>
			                                <source src="<?php echo esc_url( $video ); ?>" type="video/webm">
			                            </video>
			                        </div>		
								<?php endif; ?>

								<div <?php avi_html_attr(array('slider-overlay', $iOverlay)); ?> <?php avi_html_attr(array($cOverlay), 'style'); ?>></div>
							</div>

						<?php endwhile; ?>

					<?php else : ?>

						<div class="swiper-slide dark">
							<div class="container clearfix">
								<div class="slider-caption slider-caption-center">									
									<p><?php _e('No slides found.', 'avi'); ?></p>
								</div>
							</div>
						</div>

					<?php endif; ?>
				</div>
				<?php if( $pagination !== 'false' ) : ?>
					<div class="swiper-pagination" data-pagi-type="<?php echo esc_attr($pagination); ?>"></div>
				<?php endif; ?>
				<?php if( $hasArrow ) : ?>
					<div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
					<div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
				<?php endif; ?>
			</div>

		<?php if( $pagiType === 'thumbnail' ) : ?>
			<div class="swiper-container gallery-thumbs">
				<div class="swiper-wrapper">
					<?php foreach( $pagiThumbs as $thumb ) : ?>
						<?php if( $thumb['type'] === 'image' ) : ?>
							<div class="swiper-slide" style="background-image:url(<?php echo esc_url( $thumb['url'] ); ?>)"></div>
						<?php elseif( $thumb['type'] === 'video' ) : ?>
							<div class="swiper-slide">
	                            <video muted >
	                                <source src="<?php echo esc_url( $thumb['url'] ); ?>" type="video/webm">
	                            </video>								
							</div>
						<?php else : ?>
							<div class="swiper-slide">
								<div class="yt-bg-player" data-video="<?php echo esc_url( $thumb['url'] ); ?>"></div>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if( $parallax ) : ?>
			</div>
		<?php endif; ?>

	</section>

<?php wp_reset_postdata(); ?>

<?php 

	$GLOBALS['avi_slide_styles'] = $styles;
	function avi_slide_inline_css() {
		global $avi_slide_styles;	

		if( trim( $avi_slide_styles ) !== '' ) {
			echo '<style type="text/css">'. $avi_slide_styles .'</style>';
		}
	}
	add_action('wp_footer', 'avi_slide_inline_css');
?>