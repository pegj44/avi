<?php
// Creating the widget 
class Avi_Recent_Posts extends WP_Widget {

	function __construct() {
		parent::__construct(
			'avi_widget_recent_posts', 
			__('Avi Recent Post', 'avi'), 
			array( 'description' => __( 'Avi Recent Post', 'avi' ), ) );
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

		$date = $instance['date'] ? 1 : 0;
		$img  = $instance['img'] ? 1 : 0;
		$pnum = $instance['pnum'];

		$type = $instance['post_type']? $instance['post_type'] : 'post';

		$post_args = array(
			'post_type' => $type,
			'posts_per_page'   => $pnum,
			'orderby'          => $instance['orderby'],
			'order'            => $instance['order'],
			'post_status'      => 'publish',
		);		

		$loop = new WP_Query( $post_args );		

		if ( $loop->have_posts() ):

		?>
			<div id="post-lists" class="clearfix">

				<div id="post-list-footer">

					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

						<div class="spost clearfix">	
							<?php if (has_post_thumbnail() && $img) : ?>	
								<div class="entry-image">
									<a href="<?php the_permalink(); ?>" class="nobg"><?php the_post_thumbnail('thumbnail'); ?></a>
								</div>
							<?php endif; ?>
							<div class="entry-c">
								<div class="entry-title">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								</div>
								<?php if( $date ) : ?>
									<ul class="entry-meta">
										<li><?php echo get_the_date('jS M Y'); ?></li>
									</ul>
								<?php endif; ?>
							</div>
						</div>

					<?php endwhile; wp_reset_postdata(); ?>

				</div>

			</div>
		<?php

			else :
				echo "empty";
			endif;		

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
	  		'title' => __( 'Recent Posts', 'avi' ), 
	  		'pnum' => 5,
	  		'post_type' => 'post',
	  		'order' => 'DESC',
	  		'orderby' => 'ID',
	  		'img' => 'on',
	  		'date' => 'on'
	  		);

	    $instance = wp_parse_args( ( array ) $instance, $defaults );
	    extract($instance);

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post Type:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" type="text" value="<?php echo esc_attr( $post_type ); ?>" />
		</p>		
		<p>
			<label for="<?php echo $this->get_field_id( 'pnum' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label> 			
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'pnum' ); ?>" name="<?php echo $this->get_field_name( 'pnum' ); ?>" type="number" step="1" min="-1" value="<?php echo esc_html($pnum); ?>" size="3"><br>			
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order:' ); ?></label> 						
			<select id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
				<option value="ASC" <?php selected('ASC', $order); ?>>ASC</option>
				<option value="DESC" <?php selected('DESC', $order); ?>>DESC</option>
			</select>
		</p>	
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By:' ); ?></label> 						
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<option value="ID" <?php selected('ID', $orderby); ?>>ID</option>
				<option value="title" <?php selected('title', $orderby); ?>>Title</option>
				<option value="date" <?php selected('date', $orderby); ?>>Date</option>
				<option value="rand" <?php selected('rand', $orderby); ?>>Random</option>
			</select>
		</p>				
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'img' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'img' ); ?>" name="<?php echo $this->get_field_name( 'img' ); ?>" /> 			
			<label for="<?php echo $this->get_field_id( 'img' ); ?>"><?php _e( 'Display featured image?' ); ?></label>
		</p>		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance[ 'date' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" /> 			
			<label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
		</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_type'] = ( ! empty( $new_instance['post_type'] ) ) ? strip_tags( $new_instance['post_type'] ) : '';		
		$instance['order']  = $new_instance['order'];
		$instance['orderby']  = $new_instance[ 'orderby' ];
		$instance['pnum']  = $new_instance['pnum'];
		$instance['date']  = $new_instance[ 'date' ];
		$instance['img']   = $new_instance[ 'img' ];
		return $instance;
	}

} // Class avi_widget_recent_posts ends here

// Override default recent posts widget.
function avi_remove_widget_recent_post() {

	unregister_widget('WP_Widget_Recent_Posts');	
}

add_action( 'widgets_init', 'avi_remove_widget_recent_post' );