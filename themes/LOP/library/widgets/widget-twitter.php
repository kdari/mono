<?php

/**
 * Plugin Name: LOP2 Twitter Widget
 * Version: 1.1
 * Author: Population2
 * Author URI: http://themeforest.net/user/population2?ref=population2
 **/


add_action( 'widgets_init', 'lop_widget_twitter' );

function lop_widget_twitter() {
	register_widget( 'lop_widget_twitter' );
}

class lop_widget_twitter extends WP_Widget {

	
function lop_widget_twitter() {

	$widget_ops = array(
		'classname' => 'lop_widget_twitter',
		'description' => __('Displays the latest tweets', 'lop')
	);

	$this->WP_Widget( 'lop_widget_twitter', __('LOP Twitter','lop'), $widget_ops );
	
}



//	Outputs the options form on admin
	 
function form( $instance ) {

	$defaults = array(
	'title' => 'Latest Tweets',
	'username' => '',
	'tweetnumber' => '1',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Username:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'tweetnumber' ); ?>"><?php _e('Number of tweets:', 'lop') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'tweetnumber' ); ?>" name="<?php echo $this->get_field_name( 'tweetnumber' ); ?>" value="<?php echo $instance['tweetnumber']; ?>" />
	</p>
	
	
	<p>There can be only one Twitter widget in one page.</p>

		
	<?php
	}
	


//	Processes widget options to be saved
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['username'] = strip_tags( $new_instance['username'] );
	$instance['tweetnumber'] = strip_tags( $new_instance['tweetnumber'] );

	return $instance;
}	

//	Outputs the content of the widget
	
function widget( $args, $instance ) {
	extract( $args );

	$title = apply_filters('widget_title', $instance['title'] );
	$username = $instance['username'];
	$tweetnumber = $instance['tweetnumber'];
	

	echo $before_widget;

	if ( $title )
		echo $before_title . $title . $after_title;
	?>
		
	<div class="lop-tweet"></div> 
	<?php if ( $username ) { ?>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/jquery.tweet.js"></script>	
	<script type='text/javascript'>
		jQuery(function($){

        $(".lop-tweet").tweet({
            username: "<?php echo $username ?>",
            join_text: "auto",
            count: <?php echo $tweetnumber ?>,
            auto_join_text_default: "we said,",
            auto_join_text_ed: "we",
            auto_join_text_ing: "we were",
            auto_join_text_reply: "we replied to",
            auto_join_text_url: "we were checking out",
            loading_text: "loading tweets..."
        });

		});
	</script> 
    <?php }; ?>
	

	
	<?php 

	echo $after_widget;
	
	}

}
?>