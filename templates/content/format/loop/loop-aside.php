<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Aside post format
 *
 * @package avi
 */
?>

<div id="post-<?php the_id(); ?>" class="entry clearfix format-<?php echo get_post_format(); ?>">

	<div class="panel panel-default">
		<div class="panel-body">
			<?php the_content(); ?>
		</div>
	</div>

	<?php do_action('before_loop_content'); ?>
	<div class="entry-content">
		<a href="<?php the_permalink(); ?>#comments"class="more-link"><?php _e('View More', 'avi'); ?></a>
	</div>		
</div>