<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for next prev links.
 *
 * @package avi
 */

?>

<div class="line"></div>

<div class="post-navigation clearfix">

	<?php if( $prev ) : ?>
		<div class="col_half nobottommargin">
			<?php echo $prev; ?>
		</div>
	<?php endif; ?>

	<?php if( $next ) : ?>
		<div class="col_half col_last tright nobottommargin fright">		
			<?php echo $next; ?>
		</div>
	<?php endif; ?>

</div><!-- .post-navigation end -->