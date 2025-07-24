<?php

class Avi_Social_Links extends WP_Widget {

	function __construct() {
		parent::__construct(
			'avi_social_links', 
			__('Avi Social Links', 'avi'), 
			array( 'description' => __( 'Social media links.', 'avi' ), ) );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {		

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$align = array(
			'align' => 'avi-socials-inline',
			'left' => 'fleft',
			'right' => 'fright',
			'center' => 'avi-socials-inline avi-socials-center'
		);

		$class[] = 'social-icon';
		$class[] = $instance['size'];
		$class[] = preg_replace('/_/', ' ', $instance['style']);

		$btns = array_filter(avi_user_social_media());

		if( !empty($btns) ) {
			echo '<div class="'. $align[$instance['align']] .' clearfix">';
			foreach ($btns as $btn) {
				$link = ( $btn['title'] == 'Skype' )? esc_attr( 'skype:'. $btn['link'] .'?add' ) : esc_url( $btn['link'] );
				echo '<a href="'. $link .'" target="_blank" class="'. $btn['class'] .' '. implode(' ', $class) .'" ><i class="'. $btn['icon'] .'"></i><i class="'. $btn['icon'] .'"></i></a>';
			}
			echo '</div>';
		}

		// echo do_shortcode('[avi_socials class="'. implode(' ', $wrap_class) .'" size="'. $instance['size'] .'" iconclass="'. implode(' ', $icon_class) .'"]');

		echo $args['after_widget'];
	}
			
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

	  	$defaults = array( 
	  		'title' => '', 
	  		'style' => 9,
	  		'size' => 2,
	  		'align' => 'align',
	  		);

	    $instance = wp_parse_args( ( array ) $instance, $defaults );
	    extract($instance);

	    $style_arr = array(
	    	'square' => 'Square',
	    	'si-rounded' => 'Round',
	    	'si-dark' => 'Dark Square',
	    	'si-dark_si-rounded' => 'Dark Round',
	    	'si-light' => 'Light Square',
	    	'si-light_si-rounded' => 'Light Round',
	    	'si-borderless' => 'Borderless',
	    	'si-borderless_si-text-color' => 'Borderless Colored',
	    	'si-colored' => 'Colored Square'
	    );

		?>
		<p>
			<em><?php _e('Enter your social media links to <a href="themes.php?page=avi_options">Theme Options</a> > Social Media > Social Media Links.', 'avi') ?></em>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Button Style:' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
				
				<?php foreach( $style_arr as $skey => $sval ) : ?>
					<option value="<?php esc_attr_e($skey); ?>" <?php selected( $style, $skey ); ?>><?php esc_html_e($sval, 'avi'); ?></option>
				<?php endforeach; ?>
				
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Button Size:' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>">
				<option value="si-small" <?php selected( $size, 'si-small' ); ?>><?php esc_html_e('Small', 'avi'); ?></option>
				<option value="si-medium" <?php selected( $size, 'si-medium' ); ?>><?php esc_html_e('Medium', 'avi'); ?></option>
				<option value="si-large" <?php selected( $size, 'si-large' ); ?>><?php esc_html_e('Large', 'avi'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'align' ); ?>"><?php _e( 'Button Alignment:' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'align' ); ?>" name="<?php echo $this->get_field_name( 'align' ); ?>">
				<option value="left" <?php selected( $align, 'left' ); ?>><?php esc_html_e('Left', 'avi'); ?></option>
				<option value="right" <?php selected( $align, 'right' ); ?>><?php esc_html_e('Right', 'avi'); ?></option>
				<option value="center" <?php selected( $align, 'center' ); ?>><?php esc_html_e('Center', 'avi'); ?></option>
				<option value="align" <?php selected( $align, 'align' ); ?>><?php esc_html_e('Inline', 'avi'); ?></option>
			</select>
		</p>	
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	  	$instance['style'] = esc_attr($new_instance['style']);
	  	$instance['size']  = esc_attr($new_instance['size']);
	  	$instance['align'] = esc_attr($new_instance['align']);

		return $instance;
	}

} // Class avi_social_links ends here