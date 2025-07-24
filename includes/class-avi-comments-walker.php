<?php

/**
 * Custom comments walker
 *
 * @package avi
 *
 */

class Avi_Comments_Walker extends Walker_Comment {

	var $tree_type = 'comment';
	var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

	// constructor – wrapper for the comments list
	function __construct() { ?>

		<ol class="commentlist clearfix">
	<?php }

	// start_lvl – wrapper for child comments list
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>
		
		<ul class="children">

	<?php }

	// end_lvl – closing wrapper for child comments list
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 2; ?>

		</ul>

	<?php }

	// start_el – HTML for comment template
	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;
		$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	
	?>

		<li <?php comment_class( $parent_class ); ?> id="li-comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
			<div id="comment-<?php comment_ID() ?>" class="comment-wrap clearfix">

				<div class="comment-meta">
					<div class="comment-author vcard">
						<span class="comment-avatar clearfix">
							<?php 
								$avSize = ( $depth > 1 )? 40 : $args['avatar_size'];
								echo get_avatar( $comment, $avSize, '', __( get_comment_author() ."'s Gravatar", "avi" ) ); 							
							?>
						</span>
					</div>
				</div>
				<div class="comment-content clearfix">
					<div class="comment-author">
						<?php comment_author(); ?>
						<span><a href=""><?php comment_date('jS F Y') ?>, <?php comment_time() ?></a></span>
					</div>
					<?php comment_text(); ?>
					<?php 
						$reply_args = array(
	                        'add_below' => 'comment', 
	                        'depth' => $depth,
	                        'reply_text' => '<i class="icon-reply"></i>',
	                        'max_depth' => $args['max_depth'] 
	                        );

						comment_reply_link( array_merge( $args, $reply_args ) );  
					?>
				</div>

				<div class="clear"></div>

			</div>

	<?php }

	// end_el – closing HTML for comment template
	function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

		</li>

	<?php }

	// destructor – closing wrapper for the comments list
	function __destruct() { ?>
		
		</ol><!-- .comment-list -->
	<?php }

}
?>