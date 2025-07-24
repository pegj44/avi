<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for meta data.
 * 
 * To override this template, copy this file to your child theme including the parent folders.
 * @package avi
 */

?>

<div class="line"></div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Posted by <span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span></h3>
	</div>
	<div class="panel-body">
		<div class="author-image">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 84, '', __( "Gravatar", "avi" ) ); ?>
		</div>
		<?php echo get_the_author_meta('description'); ?>
	</div>
</div>