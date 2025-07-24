<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Image post format
 *
 * @package avi
 */
?>

<div id="post-<?php the_id(); ?>" class="entry clearfix format-<?php echo get_post_format(); ?>">

	<?php do_action('avi_image_loop', '<div class="entry-image clearfix"><a href="%image_link%" title="%title%" data-lightbox="image">', '</a></div>'); ?>

	<div class="entry-c">
		<?php do_action('before_loop_content'); ?>
		<div class="entry-content">
			<a href="<?php the_permalink(); ?>"class="more-link"><?php _e('View More', 'avi'); ?></a>
		</div>		
	</div>
</div>