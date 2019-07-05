<?php

/**
 * Plugin Name: LOP2 Flickr Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action( 'widgets_init', 'lop_widget_flickr' );

function lop_widget_flickr() {
	register_widget( 'lop_widget_flickr' );
}

class lop_widget_flickr extends WP_Widget {
	
function lop_widget_flickr() {
	
	$widget_ops = array(
		'classname' => 'lop_widget_flickr',
		'description' => __('Display Flickr photos', 'lop')
	);
	
	$this->WP_Widget( 'lop_widget_flickr', __('LOP Flickr Photos', 'lop'), $widget_ops );
}


//	Outputs the options form on admin
function form( $instance ) {
	
	$defaults = array(
		'title' => '',
		'id' => '',
		'number' => '6',
		'order' => 'latest',
	);
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Flickr ID:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" />
		<?php _e('Get your Flickr id <a href="http://get-flickr-id.ubuntu4life.com/" target="_blank">here</a>.', 'lop') ?>
		
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of photos:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e('Display order:', 'lop') ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>" >
			<option <?php if ( 'random' == $instance['order'] ) echo 'selected="selected"'; ?>>random</option>
			<option <?php if ( 'latest' == $instance['order'] ) echo 'selected="selected"'; ?>>latest</option>
		</select>
	</p>
	<?php
	}


//	Processes widget options to be saved
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['id'] = strip_tags($new_instance['id']);
	$instance['number'] = strip_tags($new_instance['number']);
	
	$instance['order'] = $new_instance['order'];


	return $instance;
}


//	Outputs the content of the widget
	
function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters('widget_title', $instance['title'] );
	$id = apply_filters('flickr_id', $instance['id']);
	$number = apply_filters('flickr_number', $instance['number']);
	$order = $instance['order'];

	echo $before_widget;
	echo '<div class="widget_flickr">';
	if ( $title )
		echo $before_title . $title . $after_title;
	if ( $id ) ?>
		<div class="flickr_container clearfix">
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number ?>&display=<?php echo $order ?>&size=s&layout=x&amp;source=user&user=<?php echo $id ?>"></script>
											
		</div>
	</div>
		<?php echo $after_widget;
	}

}
?>