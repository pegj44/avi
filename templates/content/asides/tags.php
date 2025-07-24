<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for tags.
 *
 * @package avi
 */

?>

<div class="tagcloud clearfix">
	<?php foreach($posttags as $tag) : ?>
		<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo esc_html($tag->name); ?></a>
	<?php endforeach; ?>
</div>