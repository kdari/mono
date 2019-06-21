<?php
class WPOSFLV_Widget extends WP_Widget {

    function WPOSFLV_Widget() {
        $widget_ops = array('classname' => 'WPOSFLV_Widget', 'description' => __("Embed FLV in sidebar", 'wposflv'));
		parent::WP_Widget(false, $name = 'WP OS FLV Widget', $widget_ops);
    }

    public function widget($args, $instance) {		
		extract($args);
		
		$attsArr = explode("{,}", $instance['wposflv_options']);
		$atts = "";
		if(is_array($attsArr)) {
			foreach($attsArr as $key => $value) {
				$attsKeyVal = explode('=', $value, 2);
				$atts[$attsKeyVal[0]] = $attsKeyVal[1];
			}
		}
		
		$wtitle = apply_filters('widget_title', $instance['wtitle']);?>		
		<?php echo $before_widget; ?>		
		<?php if($wtitle) echo $before_title . $wtitle . $after_title; ?>
		<?php $objWPOSFLV = new WPOSFLV(); echo $objWPOSFLV->insertPlayerCode($atts); ?>			
		<?php echo $after_widget;
    }

    public function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['wtitle'] = strip_tags($new_instance['wtitle']);
		$instance['wposflv_options'] = strip_tags($new_instance['wposflv_options']);
			return $instance;
    }

    public function form($instance) {				
        $wtitle = esc_attr($instance['wtitle']);
		$wposflv_options = esc_attr($instance['wposflv_options']);?>
		
		<p><label for="<?php echo $this->get_field_id('wtitle'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('wtitle'); ?>" name="<?php echo $this->get_field_name('wtitle'); ?>" type="text" value="<?php echo $wtitle; ?>" /></label></p>		
		<p><label for="<?php echo $this->get_field_id('wposflv_options'); ?>"><?php _e('Options:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('wposflv_options'); ?>" name="<?php echo $this->get_field_name('wposflv_options'); ?>" type="text" value="<?php echo $wposflv_options; ?>" /></label></p>
		<p style="font-size:10px;">Notes:<br />
		1. Sample Options:<br />
		src=http://example.com/test.flv{,}previewimage=http://example.com/test.png{,}width=320{,}height=200<br />
		2. User "{,}" as separator between different options as in note 1</p>
	<?php }
}

?>