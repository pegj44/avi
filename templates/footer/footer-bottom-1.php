<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for footer bottom layout 1 
 *
 * @package avi
 */

global $option;

?>

<div id="copyrights" class="footer-bottom-1">

	<div class="container clearfix">
		<?php if( $option['avi-upperleft-element'] || $option['avi-bottomleft-element'] ) : ?>
			<div class="col_half clearfix">
				<?php apply_filters( 'avi_footer_elements', 'avi-upperleft-element', '<div class="fleft">', '</div>' ); ?>
				<?php apply_filters( 'avi_footer_elements', 'avi-bottomleft-element', '<div class="fleft">', '</div>' ); ?>
			</div>
		<?php endif; ?>

		<?php if( $option['avi-upperright-element'] || $option['avi-bottomright-element'] ) : ?>
			<div class="col_half col_last clearfix">
				<?php apply_filters( 'avi_footer_elements', 'avi-upperright-element', '<div class="fright">', '</div>' ); ?>
				<?php apply_filters( 'avi_footer_elements', 'avi-bottomright-element', '<div class="fright">', '</div>' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>