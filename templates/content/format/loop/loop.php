<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Standard post format
 *
 * @package avi
 */

global $option;

?>

<div id="post-<?php the_id(); ?>" class="entry clearfix">

	<?php if( has_post_thumbnail() ) : ?>
		<div class="entry-image">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-c">

		<?php 
			do_action( 'before_loop_content' );
		?>

		<div class="entry-content">
			<?php do_action('avi_excerpt'); ?>
		</div>
	</div>

</div>