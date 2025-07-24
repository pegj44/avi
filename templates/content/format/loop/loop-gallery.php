<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Gallery post format
 *
 * @package avi
 */
?>

<div id="post-<?php the_id(); ?>" class="entry clearfix format-<?php echo get_post_format(); ?>">

	<?php do_action('avi_gallery_loop', '<div class="entry-image clearfix">', '</div>'); ?>

	<div class="entry-c">

		<?php do_action('before_loop_content'); ?>
		<div class="entry-content">
			<?php do_action('avi_excerpt'); ?>
		</div>
	</div>

</div>