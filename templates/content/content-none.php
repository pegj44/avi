<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * The template used for displaying 404
 *
 * @package avi
 */
?>

	<div class="heading-block nobottomborder">
		<?php if(is_search()) : ?>
			<h4><?php _e('Sorry, but nothing matched your search terms.', 'avi'); ?></h4>
			<span><?php _e("Please try again with some different keywords:", "avi"); ?></span>
		<?php else: ?>
			<h4><?php _e("Ooopps.! The Page you were looking for, couldn't be found.", "avi"); ?></h4>
			<span><?php _e("Try searching for the best match or browse the links below:", "avi"); ?></span>
		<?php endif; ?>				
	</div>

	<?php get_search_form(); ?>

	<div class="menu404 widget_links topmargin nobottommargin">
	    <?php 
	        if ( has_nav_menu( 'primary' ) ) {
	            wp_nav_menu( array(
	                'menu'              => 'primary',
	                'theme_location'    => 'primary',
	                'depth'             => 1,
	                'container'         => false,
	                'menu_class'        => 'clearfix',
	                'fallback_cb'       => 'Avi_Nav_Walker::fallback',
					)
	            );
	        }                
	    ?>   				
	</div>