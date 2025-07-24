<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * The template used for displaying post content in single.php
 *
 * @package avi
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('single-post nobottommargin'); ?>>

	<?php do_action('avi_post_before'); ?>

	<?php get_template_part( 'templates/content/format/single/format', get_post_format() ); ?>

	<?php 
		/*
		 * @hooked avi_get_pagination - 10
		 * @hooked avi_get_article_author - 20
		 * @hooked avi_get_post_related - 30
		 * @hooked avi_get_article_comments - 40
		 */
		do_action('avi_post_after'); 
	?>

</div>