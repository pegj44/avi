<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for footer widget area
 *
 * @package avi
 */

?>

<div id="footer" class="site-footer clearfix">
	<div class="container">
		<div class="footer-widgets-wrap clearfix">
			<?php do_action('avi_footer_widgets'); ?>
		</div>
	</div>
</div>