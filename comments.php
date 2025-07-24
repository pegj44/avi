<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Comments template
 *
 * @package avi
 */

if ( post_password_required() ) {
	return;
}

?>

<div class="line"></div>

<div id="comments" class="clearfix">

	<?php if ( have_comments() ) : ?>

		<h3 class="comments-title">
			<?php printf( _nx( '<span>1</span> Comment', '<span>%1$s</span> Comments', get_comments_number(), 'comments title', 'avi' ), number_format_i18n( get_comments_number() ) ); ?>
		</h3>

		<?php do_action('avi_comments_nav'); ?>
		
			<?php
				wp_list_comments( array(
					'short_ping'  => true,
					'avatar_size' => 60,
					'walker'	  => new Avi_Comments_Walker()
				) );
			?>

		<?php do_action('avi_comments_nav'); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<h5 class="no-comments"><?php _e( 'Comments are closed.', 'avi' ); ?></h5>
	<?php endif; ?>

	<?php 

		$fields = '<div class="col_one_third comment-form-author">
						<label for="author">'. __('Name', 'avi') .' <span class="required">*</span></label> 
						<input id="author" name="author" type="text" value="" size="22" aria-required="true" required="required" class="sm-form-control">
					</div>
					<div class="col_one_third comment-form-email">
						<label for="email">'. __('Email', 'avi') .' <span class="required">*</span></label> 
						<input id="email" name="email" type="text" value="" size="22" aria-describedby="email-notes" aria-required="true" required="required" class="sm-form-control">
					</div>
					<div class="col_one_third col_last comment-form-url">
						<label for="url">'. __('Website', 'avi') .'</label> 
						<input id="url" name="url" type="text" value="" size="22" class="sm-form-control">
					</div>';

		$args = array(
				'title_reply'	 => __( 'Leave a <span>Comment</span>', 'avi' ),
				'title_reply_to' => __( 'Leave a Reply to %s', 'avi' ),
				'comment_notes_before' => '<h5 class="comment-notes t400">'. __('<span id="email-notes">Your email address will not be published</span>. Required fields are marked.', 'avi') .'<b>*</b></h5>',
				'logged_in_as' => '<h5 class="logged-in-as t400">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'avi' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</h5>',
				'fields' 		 => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field'  => '<div class="col_full"><label for="comment">' . _x( 'Comment', 'noun', 'avi' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="sm-form-control"></textarea></div>',
				'class_submit'   => 'button button-3d nomargin',
				'label_submit'   =>  __( 'Submit Comment', 'avi' ),
			);


		comment_form($args); 

	?>

</div><!-- .comments-area -->