<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for meta data.
 *
 * @package avi
 */

	$icons = array(
			'date'     => '<i class="icon-calendar3"></i>',
			'author'   => '<i class="icon-user"></i>',
			'category' => '<i class="icon-folder-open"></i>',
			'comments' => '<i class="icon-comments"></i>',
			'format'   => ''
		);
?>

<ul class="entry-meta clearfix" >

	<?php foreach( $fields as $key => $field ) : ?>
		<li><?php echo $icons[$key] .' '. $field; ?></li>
	<?php endforeach; ?>

</ul>