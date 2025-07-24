<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for share links.
 *
 * @package avi
 */

?>

<div <?php avi_html_attr(array('share-links', 'clearfix', $isfloat), 'class'); ?>>
	<?php if( '' != $sharetxt && !$isfloat ) : ?>
		<h5 style="margin-bottom:10px;"><?php echo esc_html($sharetxt); ?>:</h5>
	<?php endif; ?>
	<div class="<?php echo $float; ?>">

		<?php echo apply_filters('avi_social_buttons', '<a href="{link}" class="{class} social-icon" title="{name}" style="{style}"><i class="{icon}"></i><i class="{icon}"></i></a>', $socials, 'share'); ?>

	</div>
</div>