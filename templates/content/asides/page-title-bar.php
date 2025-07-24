<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for page title bar
 *
 * @package avi
 */

?>

<section <?php avi_html_attr( array($dark) ); ?>>
	<div id="page-title" <?php avi_html_attr( $style, 'style' ); ?>>
		<div class="container clearfix">
		
			<?php 

				do_action('avi_page_titlebar');

				avi_breadcrumbs();
			?>

		</div>
	</div>
</section>