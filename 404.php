<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for displaying 404 page
 *
 * @package avi
 */

	get_header();
?>

<?php 

	/**
	 * @hooked avi_top_bar - 10
	 * @hooked avi_get_top_slider - 20
	 * @hooked avi_main_header - 30
	 * @hooked avi_get_bottom_slider - 40
	 * @hooked avi_title_bar - 50
	 */
	do_action( 'avi_header' ); 
?>

<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<div class="col_half nobottommargin">
				<div class="error404-txt center">404</div>
			</div>

			<div class="col_half nobottommargin col_last">
				<?php get_template_part('templates/content/content-none'); ?>
			</div>

		</div>
	</div>
</section>

<?php 
	/**
	 * @hooked avi_get_footer_widget_area - 10
	 * @hooked avi_get_footer_bottom_area - 20
	 */
	do_action( 'avi_footer' ); 
?>

<?php get_footer(); ?>