<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * The template used for displaying page content in page.php
 *
 * @package avi
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php do_action('avi_page_before'); ?>

		<div class="entry clearfix">

			<?php 
				/**
				 * @hooked avi_get_title - 10
				 * @hooked avi_metadata - 20
				 * @hooked avi_featured_image - 30
				 * @hooked avi_share_buttons_before - 40
				 */
				do_action('avi_content_before'); 
			?>
			
			<div class="entry-content notopmargin">
				<?php the_content(); ?>
			</div>
			
			<?php 
				/**
				 * @hooked avi_meta_tags - 10
				 * @hooked avi_share_buttons_after - 20
				 */
				do_action('avi_content_after'); 
			?>			

		</div>
		
	<?php do_action('avi_page_after'); ?>
	
</article>