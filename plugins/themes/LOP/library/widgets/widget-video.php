<?php

/**
 * Plugin Name: LOP2 Video Widget
 * Version: 1.0
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action( 'widgets_init', 'lop_widget_video' );

function lop_widget_video() {
	register_widget( 'lop_widget_video' );
}


class lop_widget_video extends WP_Widget {

function lop_widget_video() {

// Widget settings
	$widget_ops = array(
		'classname' => 'lop_widget_video',
		'description' => __('Display video', 'lop')
	);

	$this->WP_Widget( 'lop_widget_video', __('LOP Video', 'lop'), $widget_ops );
	
}


//	Outputs the options form on admin
	
function form( $instance ) {

	$defaults = array(
		'title' => '',
		'code' => '',
		'caption' => '',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'code' ); ?>"><?php _e('Embed code (iframe):', 'lop') ?></label>
		<textarea style="height:140px;" class="widefat" id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['code'] ), ENT_QUOTES)); ?></textarea>
		Tips: Adjust the iframe width accordingly.
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'caption' ); ?>"><?php _e('Caption:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'caption' ); ?>" name="<?php echo $this->get_field_name( 'caption' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['caption'] ), ENT_QUOTES)); ?>" />
	</p>
	
	<?php
	}


//	Processes widget options to be saved
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	
	$instance['caption'] = stripslashes( $new_instance['caption']);
	$instance['code'] = stripslashes( $new_instance['code']);

	return $instance;
}

//	Outputs the content of the widget
	
function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters('widget_title', $instance['title'] );
	$code = $instance['code'];
	$caption = $instance['caption'];

	echo $before_widget;

	if ( $title )
		echo $before_title . $title . $after_title;

	?>
		
		<div class="video_container">
			<?php echo $code ?>
		</div>
		<p class="video_caption"><?php echo $caption ?></p>
	
	<?php

	echo $after_widget;
	}

}
?>