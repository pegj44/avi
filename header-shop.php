<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for shop header
 * @package avi
 */

global $option;
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php avi_html_attr(array($option['avi-loading-style']), 'data-loader') ?> <?php avi_html_attr(array($option['avi-preload-color']), 'data-loader-color') ?>>

	<div id="wrapper" class="clearfix"> <!-- Main wrapper -->

		<?php 

			/**
			 * @hooked avi_top_bar - 10
			 * @hooked avi_get_top_slider - 20
			 * @hooked avi_main_header - 30
			 * @hooked avi_get_bottom_slider - 40
			 * @hooked avi_title_bar - 50
			 */
			do_action( 'avi_header' ); 
		?>

		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
				<?php 
					/**
					 * @hooked avi_left_sidebar - 0 ( Outputs left sidebar and opening wrapper )
					 * @hooked avi_get_title - 10
					 */
					do_action( 'avi_before_loop' ); 
				?>