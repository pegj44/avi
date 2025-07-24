<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for featured image.
 *
 * @package avi
 */

?>

<?php if( has_post_thumbnail() ) : ?>
	<!-- Entry Image
	============================================= -->
	<div class="entry-image">
		<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" data-lightbox="image">
			<?php the_post_thumbnail('full'); ?>
		</a>
	</div><!-- .entry-image end -->
	
<?php endif; ?>