<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

?>

<!-- Top Bar
============================================= -->
<div id="top-bar" <?php avi_html_attr(array($width, $dark), 'class'); ?>>
	<div class="container clearfix">			
		<div class="col_half nobottommargin">
			<?php do_action('avi_topbar_item', 'left'); ?>
		</div>
		<div class="col_half fright col_last nobottommargin">
			<?php do_action('avi_topbar_item', 'right'); ?>
		</div>
	</div>
</div><!-- #top-bar end -->