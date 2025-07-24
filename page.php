<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for displaying default page.
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
			
			<?php 
				/**
				 * @hooked avi_left_sidebar - 0 ( Outputs left sidebar and opening wrapper )
				 * @hooked avi_get_title - 10
				 */
				do_action( 'avi_before_loop' ); 
			?>

				<?php while ( have_posts() ) : the_post(); ?>					

					<?php get_template_part( 'templates/content/content', 'page' ); ?>				

				<?php endwhile; ?>

			<?php 
				/**
				 * @hooked avi_right_sidebar - 0 ( Outputs right sidebar and closing wrapper )
				 */
				do_action( 'avi_after_loop' ); 
			?>
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