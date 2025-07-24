<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for load more ajax.
 *
 * @package avi
 */
?>

<div id="load-next-posts" class="hidden center">
	<a href="<?php echo get_next_posts_page_link(); ?>" class="button button-3d button-dark button-large button-rounded">Load more..</a>
</div>