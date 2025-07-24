<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for top contact.
 *
 * @package avi
 */
	
	global $option;
?>

<p class="nobottommargin"> 
	<?php if( $option['avi-top-phone'] ) : ?>
		<a href="tel:<?php echo esc_html($option['avi-top-phone']); ?>" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text"><?php echo esc_html($option['avi-top-phone']); ?></span></a>
	<?php endif; ?>

	<?php if( $option['avi-top-email'] ) : ?>
		<a href="mailto:<?php echo esc_html($option['avi-top-email']); ?>" class="si-email3"><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text"><?php echo esc_html($option['avi-top-email']); ?></span></a>
	<?php endif; ?>
</p>