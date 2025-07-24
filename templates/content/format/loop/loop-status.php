<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Standard post format
 *
 * @package avi
 */

global $post;
?>

<div id="post-<?php the_id(); ?>" class="entry clearfix format-<?php echo get_post_format(); ?>">

	<div class="entry-image">
		<div class="panel panel-default nobottommargin">
			<div class="panel-body">
				<div class="status-gravatar"><?php echo get_avatar( get_the_author_meta( 'ID', $post->post_author ), 84, '', __( "Gravatar", "avi" ) ); ?></div>
				<?php do_action('avi_excerpt'); ?>
			</div>
		</div>
	</div>

	<div class="entry-c">

		<?php do_action('before_loop_content'); ?>

		<div class="entry-content">
			<a href="<?php the_permalink(); ?>"class="more-link"><?php _e('View More', 'avi'); ?></a>
		</div>
		
	</div>

</div>