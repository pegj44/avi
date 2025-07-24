<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for top socials.
 *
 * @package avi
 */

$socials = avi_user_social_media();

?>

<?php if( !empty($socials) ) : ?>

	<div id="top-social">
	  <ul>
	    <?php foreach( array_filter( $socials ) as $social ) : ?>
	      <li><a href="<?php echo esc_url($social['link']); ?>" class="<?php echo esc_attr($social['class']); ?>" target="_blank"><span class="ts-icon"><i class="<?php echo esc_attr($social['icon']); ?>"></i></span><span class="ts-text"><?php echo esc_attr($social['title']); ?></span></a></li>
	    <?php endforeach; ?>
	  </ul>
	</div><!-- #top-social end -->

<?php endif; ?>