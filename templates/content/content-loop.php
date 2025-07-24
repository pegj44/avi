<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Default loop template with format.
 *
 * @package avi
 */

?>

<div id="posts" <?php avi_html_attr( avi_archive_class(), 'class' ); ?>>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'templates/content/format/loop/loop', get_post_format() ); ?>

	<?php endwhile; ?>

</div>