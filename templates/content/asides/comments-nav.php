<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for comments navigation.
 *
 * @package avi
 */

?>

<nav class="navigation comment-navigation" role="navigation">
	<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfifteen' ); ?></h2>
	<div class="nav-links">
		<?php
			if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'twentyfifteen' ) ) ) :
				printf( '<div class="nav-previous">%s</div>', $prev_link );
			endif;

			if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'twentyfifteen' ) ) ) :
				printf( '<div class="nav-next">%s</div>', $next_link );
			endif;
		?>
	</div><!-- .nav-links -->
</nav><!-- .comment-navigation -->