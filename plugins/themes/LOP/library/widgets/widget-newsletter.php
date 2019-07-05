<?php

/**
 * Plugin Name: LOP2 Newsletter widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action( 'widgets_init', 'lop_widget_newsletter' );

function lop_widget_newsletter() {
	register_widget( 'lop_widget_newsletter' );
}

class lop_widget_newsletter extends WP_Widget {

function lop_widget_newsletter() {

	$widget_ops = array(
		'classname' => 'lop_widget_newsletter',
		'description' => __('A widget to display newsletter subscription link', 'lop')
	);

	$this->WP_Widget( 'lop_widget_newsletter', __('LOP Newsletter', 'lop'), $widget_ops );
	
}


//	Outputs the options form on admin
	
function form( $instance ) {

	$defaults = array(
		'title' => '',
		'subheading' => '',
		'link' => ''
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'subheading' ); ?>"><?php _e('Sub heading text:', 'lop') ?></label>

        <textarea style="height:140px;" class="widefat" id="<?php echo $this->get_field_id( 'subheading' ); ?>" name="<?php echo $this->get_field_name( 'subheading' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['subheading'] ), ENT_QUOTES)); ?></textarea>
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Button URL:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
	</p>
	
	<?php
	}


//	Processes widget options to be saved
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['subheading'] = $new_instance['subheading'] ;
	$instance['link'] = $new_instance['link'];
	return $instance;
}

//	Outputs the content of the widget
	
function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters('widget_title', $instance['title'] );
	$subheading = $instance['subheading'];
	$link = $instance['link'];

	echo $before_widget;
    echo '<div class="inset-box"><h3 class="replace"><a href="'.$link.'">'.$title.'</a></h3>';
    echo '<p>'.$subheading.'</p></div>';
	echo $after_widget;
	}

}
?>