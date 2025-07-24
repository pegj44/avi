<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * @package avi
 */

global $option;
?>
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

</div> <!-- End main wrapper -->

<?php if($option['avi-scrolltop']) : ?>
	<div id="gotoTop" class="icon-angle-up"></div>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>