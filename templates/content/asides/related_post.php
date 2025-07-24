<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for related posts.
 *
 * @package avi
 */

?>

<div class="line"></div>

<h4><?php _e('Related Posts:', 'avi'); ?></h4>

<?php if ( $loop->have_posts() ): ?>

	<div class="related-posts clearfix">

		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<div class="mpost col_half nobottommargin clearfix">

				<?php if( has_post_thumbnail() ) : ?>
					<div class="entry-image">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-related'); ?></a>
					</div>
				<?php endif; ?>

				<div class="entry-c">
					<div class="entry-title">
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</div>

					<?php do_action('avi_loop_meta'); ?>

					<div class="entry-content"><?php echo wp_trim_words(get_the_excerpt(), 12, '...'); ?></div>
				</div>

			</div>
			
		<?php endwhile; ?>

	</div>
<?php endif; ?>	