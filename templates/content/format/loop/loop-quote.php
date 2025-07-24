<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Quote post format
 *
 * @package avi
 */

global $post;
$author = $post->post_author;

?>

<div id="post-<?php the_id(); ?>" class="entry clearfix format-<?php echo get_post_format(); ?>">

	<div class="entry-image">
		<blockquote>
			<p><?php echo get_the_content(); ?></p>
			<footer><?php echo get_the_author_meta( 'display_name', $author ); ?></footer>
		</blockquote>
	</div>

	<div class="entry-c">
		<?php do_action('before_loop_content'); ?>
	</div>

</div>