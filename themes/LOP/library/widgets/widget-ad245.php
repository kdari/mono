<?php

/**
 * Plugin Name: LOP2 Ad Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action( 'widgets_init', 'lop_widget_ad' );

function lop_widget_ad() {
	register_widget( 'lop_widget_ad' );
}

class lop_widget_ad extends WP_Widget {

function lop_widget_ad() {

	$widget_ops = array(
		'classname' => 'lop_widget_ad',
		'description' => __('A widget to display 285x180 ad or image', 'lop')
	);

	$this->WP_Widget( 'lop_widget_ad', __('LOP 285x180 Ad', 'lop'), $widget_ops );
	
}


//	Outputs the options form on admin
	
function form( $instance ) {

	$defaults = array(
		'title' => '',
		'img_src' => get_template_directory_uri()."/img/dummy-ad.jpg",
		'link' => 'http://themeforest.net/user/population2?ref=population2',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'img_src' ); ?>"><?php _e('Image source url:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'img_src' ); ?>" name="<?php echo $this->get_field_name( 'img_src' ); ?>" value="<?php echo $instance['img_src']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Ad link:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
	</p>
	
	<?php
	}


//	Processes widget options to be saved
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['img_src'] = $new_instance['img_src'];
	$instance['link'] = $new_instance['link'];

	return $instance;
}

//	Outputs the content of the widget
	
function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters('widget_title', $instance['title'] );
	$img_src = $instance['img_src'];
	$link = $instance['link'];

	echo $before_widget;
	if ( $title )
		echo $before_title . $title . $after_title;
	if ( $link )
		echo '<a href="' . $link . '"><img class="shadow-light" src="' . $img_src . '" width="285" height="180" /></a>';
	elseif ( $img_src )
	 	echo '<img class="shadow-light" src="' . $img_src . '" width="285" height="180" />';
	echo $after_widget;
	}

}
?>