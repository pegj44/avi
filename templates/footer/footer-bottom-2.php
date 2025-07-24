<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for footer bottom layout 2
 *
 * @package avi
 */

global $option;

?>

<div id="copyrights" class="footer-bottom-2">

	<div class="container clearfix">

		<?php if( $option['avi-uppercenter-element'] || $option['avi-bottomcenter-element'] ) : ?>
			<div class="col_full nobottommargin">
				<?php echo apply_filters( 'avi_footer_elements', 'avi-uppercenter-element', '<div class="divcenter text-center">', '</div>' ); ?>
				<?php echo apply_filters( 'avi_footer_elements', 'avi-bottomcenter-element', '<div class="divcenter text-center">', '</div>' ); ?>					
			</div>
		<?php endif; ?>

	</div>
</div>