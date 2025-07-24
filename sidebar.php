<?php

if ( ! defined( 'ABSPATH' ) ) exit; // File Security Check

/**
 * Template for displaying sidebar.
 *
 * @package avi
 */
	
	$widget = (isset($widget))? $widget : 'blog-right-widget';
?>

<?php if( is_active_sidebar( $widget ) && dynamic_sidebar( $widget ) ) : else : ?>

	<?php 
		$args = array(
				'before_widget' => '<div id="" class="widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widgettitle">',
				'after_title'   => '</h4>'
			);

		if( is_user_logged_in() ) : 

			the_widget( 'WP_Widget_Text', array('title' => 'Sidebar', 'text' => 'Click <a href="'. admin_url( 'widgets.php' ) .'">HERE</a> to add widgets.'), $args );

		else :

			the_widget('WP_Widget_Meta', '', $args);

		endif; 
	?>
<?php endif; ?>