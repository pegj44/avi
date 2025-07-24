<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

global $option;

$dir = ( $option['avi-rtl'] )? 'rtl' : 'ltr';
?>

<!DOCTYPE html>

<html dir="<?php esc_attr_e($dir); ?>" <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php avi_html_attr(array($option['avi-loading-style']), 'data-loader') ?> <?php avi_html_attr(array($option['avi-preload-color']), 'data-loader-color') ?>>

	<div id="wrapper" class="clearfix"> <!-- Main wrapper -->