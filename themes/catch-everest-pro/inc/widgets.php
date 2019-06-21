<?php
/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Catch Everest 1.0
 */
function catcheverest_widgets_init() {
	
	// Register Custom Widgets
	register_widget( 'catcheverest_social_widget' );
	register_widget( 'catcheverest_adspace_widget' );
	register_widget( 'catcheverest_featued_widget' );
	register_widget( 'catcheverest_page_widget' );
	register_widget( 'catcheverest_post_widget' );
	
	//Main Sidebar
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'catcheverest' ),
		'id' => 'sidebar-1',
		'description'   	=> __( 'Shows the Widgets at the side of Content', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	//Header Top Sidebar
	register_sidebar( array(
		'name' => __( 'Header Top Sidebar', 'catcheverest' ),
		'id' => 'sidebar-header-top',
		'description'   	=> __( 'Shows the Widgets at the Top of Header', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	
	
	//Header Right Sidebar
	register_sidebar( array(
		'name' => __( 'Header Right Sidebar', 'catcheverest' ),
		'id' => 'sidebar-header-right',
		'description'   	=> __( 'Shows the Widgets at the Top Right Side of Header', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	
	//Optional Sidebar for Hompeage instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Homepage Sidebar', 'catcheverest' ),
		'id' 				=> 'sidebar-optional-homepage',
		'description'		=> __( 'This is Optional Sidebar for Homepage', 'catcheverest' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );	
	
	//Optional Sidebar for Archive instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Archive Sidebar', 'catcheverest' ),
		'id' 				=> 'sidebar-optional-archive',
		'description'		=> __( 'This is Optional Sidebar for Archive', 'catcheverest' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );
	
	//Optional Sidebar for Page instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Page Sidebar', 'catcheverest' ),
		'id' 				=> 'sidebar-optional-page',
		'description'		=> __( 'This is Optional Sidebar for Page', 'catcheverest' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );
	
	//Optional Sidebar for Post instead of main sidebar
	register_sidebar( array(
		'name' 				=> __( 'Optional Post Sidebar', 'catcheverest' ),
		'id' 				=> 'sidebar-optional-post',
		'description'		=> __( 'This is Optional Sidebar for Post', 'catcheverest' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );	
	
	//Optional Sidebar one for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar One', 'catcheverest' ),
		'id' 				=> 'sidebar-optional-one',
		'description'		=> __( 'This is Optional Sidebar One', 'catcheverest' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );
	
	//Optional Sidebar two for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar Two', 'catcheverest' ),
		'id' 				=> 'sidebar-optional-two',
		'description'		=> __( 'This is Optional Sidebar Two', 'catcheverest' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );	
	
	//Optional Sidebar Three for page and post
	register_sidebar( array(
		'name' 				=> __( 'Optional Sidebar Three', 'catcheverest' ),
		'id' 				=> 'sidebar-optional-three',
		'description'		=> __( 'This is Optional Sidebar Three', 'catcheverest' ),
		'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget' 		=> "</aside>",
		'before_title' 		=> '<h3 class="widget-title">',
		'after_title' 		=> '</h3>'
	) );		
		
	
	//Footer One Sidebar
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'catcheverest' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your site footer', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	//Footer Two Sidebar
	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'catcheverest' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	//Footer Three Sidebar
	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'catcheverest' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'catcheverest' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );		
	
}
add_action( 'widgets_init', 'catcheverest_widgets_init' );


/**
 * Makes a custom Widget for Displaying Social Icons
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */
class catcheverest_social_widget extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function catcheverest_social_widget() {
		$widget_ops = array( 'classname' => 'widget_catcheverest_social_widget', 'description' => __( 'Use this widget to add Social Icons from Social Icons Settings as a widget. ', 'catcheverest' ) );
		$this->WP_Widget( 'widget_catcheverest_social_widget', __( '1. Catch Everest: Social', 'catcheverest' ), $widget_ops );
		$this->alt_option_name = 'widget_catcheverest_social_widget';
	}

	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = esc_attr( $instance[ 'title' ] );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','catcheverest'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <?php
	}
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}	
	
	/**
	 * Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = !empty( $instance['title'] ) ? $instance[ 'title' ] : '';
			
		echo $before_widget;
		if ( $title != '' ) {
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		} 

		catcheverest_social_networks();
		
		echo $after_widget;
	}

}


/**
 * Makes a custom Widget for Displaying Ads
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */
class catcheverest_adspace_widget extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function catcheverest_adspace_widget() {
		$widget_ops = array( 'classname' => 'widget_catcheverest_adspace_widget', 'description' => __( 'Use this widget to add any type of Advertisement as a widget.', 'catcheverest' ) );
		$this->WP_Widget( 'widget_catcheverest_adspace_widget', __( '2. Catch Everest: Advertisement', 'catcheverest' ), $widget_ops );
		$this->alt_option_name = 'widget_catcheverest_adspace_widget';
	}

	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'adcode' => '', 'image' => '', 'href' => '', 'target' => '0', 'alt' => '' ) );
		$title = esc_attr( $instance[ 'title' ] );
		$adcode = esc_textarea( $instance[ 'adcode' ] );
		$image = esc_url( $instance[ 'image' ] );
		$href = esc_url( $instance[ 'href' ] );
		$target = $instance['target'] ? 'checked="checked"' : '';
		$alt = esc_attr( $instance[ 'alt' ] );
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','catcheverest'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <?php if ( current_user_can( 'unfiltered_html' ) ) : // Only show it to users who can edit it ?>
            <p>
                <label for="<?php echo $this->get_field_id('adcode'); ?>"><?php _e('Advertisement Code:','catcheverest'); ?></label>
                <textarea name="<?php echo $this->get_field_name('adcode'); ?>" class="widefat" id="<?php echo $this->get_field_id('adcode'); ?>"><?php echo $adcode; ?></textarea>
            </p>
            <p><strong>or</strong></p>
        <?php endif; ?>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','catcheverest'); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','catcheverest'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_url( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $target; ?> id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" /> <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Open Link in New Window', 'catcheverest' ); ?></label>
		</p>        
        <p>
            <label for="<?php echo $this->get_field_id('alt'); ?>"><?php _e('Alt text:','catcheverest'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('alt'); ?>" value="<?php echo $alt; ?>" class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" />
        </p>
        <?php
	}
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['adcode'] = wp_kses_stripslashes($new_instance['adcode']);
		$instance['image'] = esc_url_raw($new_instance['image']);
		$instance['href'] = esc_url_raw($new_instance['href']);
		$instance[ 'target' ] = isset( $new_instance[ 'target' ] ) ? 1 : 0;
		$instance['alt'] = sanitize_text_field($new_instance['alt']);
		
		return $instance;
	}	
	
	/**
	 * Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = !empty( $instance['title'] ) ? $instance[ 'title' ] : '';
		$adcode = !empty( $instance['adcode'] ) ? $instance[ 'adcode' ] : '';
		$image = !empty( $instance['image'] ) ? $instance[ 'image' ] : '';
		$href = !empty( $instance['href'] ) ? $instance[ 'href' ] : '';
		$target = !empty( $instance[ 'target' ] ) ? 'true' : 'false';
		$alt = !empty( $instance['alt'] ) ? $instance[ 'alt' ] : '';

		if ( $target == "true" ) :
			$base = '_blank'; 	
		else:
			$base = '_self'; 	
		endif;	
			
		echo $before_widget;
		if ( $title != '' ) {
			echo $before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title;
		} 

		if ( $adcode != '' ) {
			echo $adcode;
		}
		elseif ( $image != '' ) {
        	echo '<a href="'.$href.'" target="'.$base.'"><img src="'. $image.'" alt="'.$alt.'" /></a>';
		}
		else {
			_e( 'Add Advertisement Code or Image URL', 'catcheverest' );
		}
		echo $after_widget;
	}

} 


/**
 * Makes a custom Widget for Displaying Advertisement
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */
class catcheverest_featued_widget extends WP_Widget {
	
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function catcheverest_featued_widget() {
		$widget_ops = array( 'classname' => 'widget_catcheverest_featued_widget', 'description' => __( 'Use this widget to add Featued Content as a widget.', 'catcheverest' ) );
		$this->WP_Widget( 'widget_catcheverest_featued_widget', __( '3. Catch Everest: Featued Content', 'catcheverest' ), $widget_ops );
		$this->alt_option_name = 'widget_catcheverest_featued_widget';
	}

	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'content' => '', 'image' => '', 'href' => '', 'target' => '0', 'image_position' => 'above' ) );
		$title = esc_attr( $instance[ 'title' ] );
		$content = esc_textarea( $instance[ 'content' ] );
		$image = esc_url( $instance[ 'image' ] );
		$href = esc_url( $instance[ 'href' ] );
		$target = $instance['target'] ? 'checked="checked"' : '';
		$image_position = $instance[ 'image_position' ];
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','catcheverest'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <?php if ( current_user_can( 'unfiltered_html' ) ) : // Only show it to users who can edit it ?>
            <p>
                <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:','catcheverest'); ?></label>
                <textarea name="<?php echo $this->get_field_name('content'); ?>" class="widefat" id="<?php echo $this->get_field_id('content'); ?>"><?php echo $content; ?></textarea>
            </p>
        <?php endif; ?>
        <p>
            <label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image Url:','catcheverest'); ?></label>
        <input type="text" name="<?php echo $this->get_field_name('image'); ?>" value="<?php echo $image; ?>" class="widefat" id="<?php echo $this->get_field_id('image'); ?>" />
        </p>


		<p>
			<input class="checkbox" type="checkbox" <?php echo $target; ?> id="<?php echo $this->get_field_id('target'); ?>" name="<?php echo $this->get_field_name('target'); ?>" /> <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Open Link in New Window', 'catcheverest' ); ?></label>
		</p>
 

	    <?php if( $image_position == 'above' ) { ?>  
		<p> 
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" checked /><?php _e( 'Show Image Before Title', 'catcheverest' );?><br />  
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" /><?php _e( 'Show Image After Title', 'catcheverest' );?><br />              
		</p>  
		<?php } else { ?> 
		<p>   
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" /><?php _e( 'Show Image Before Title', 'catcheverest' );?><br />  
		    <input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" checked /><?php _e( 'Show Image After Title', 'catcheverest' );?><br />              
		</p>  
		<?php } ?>  
        
        <p>
            <label for="<?php echo $this->get_field_id('href'); ?>"><?php _e('Link URL:','catcheverest'); ?></label>
            <input type="text" name="<?php echo $this->get_field_name('href'); ?>" value="<?php echo esc_url( $href ); ?>" class="widefat" id="<?php echo $this->get_field_id('href'); ?>" />
        </p>
        <?php
	}
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['content'] = wp_kses_stripslashes($new_instance['content']);
		$instance['image'] = esc_url_raw($new_instance['image']);
		$instance['href'] = esc_url_raw($new_instance['href']);
		$instance[ 'target' ] = isset( $new_instance[ 'target' ] ) ? 1 : 0;
		$instance[ 'image_position' ] = $new_instance[ 'image_position' ];
		
		return $instance;
	}	
	
	/**
	 * Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		$title = !empty( $instance['title'] ) ? $instance[ 'title' ] : '';
		$content = !empty( $instance['content'] ) ? $instance[ 'content' ] : '';
		$image = !empty( $instance['image'] ) ? $instance[ 'image' ] : '';
		$href = !empty( $instance['href'] ) ? $instance[ 'href' ] : '';
		$target = !empty( $instance[ 'target' ] ) ? 'true' : 'false';
		$image_position = isset( $instance[ 'image_position' ] ) ? $instance[ 'image_position' ] : 'above' ;

		
		if ( $target == "true" ) :
			$base = '_blank'; 	
		else:
			$base = '_self'; 	
		endif;		
		
		// Title
		if ( !empty( $title ) ) :
			$finaltitle = $before_title;
			if ( !empty( $href ) ) {
				$finaltitle .= '<a title="'.$title.'" href="'.$href .'" target="'.$base.'">'.$title.'</a>'; 
			}
			else {
				$finaltitle .= $title;
			}
			$finaltitle .= $after_title;
		
		else:
			$finaltitle = ''; 
		endif;
		

		// Image 
		if ( !empty( $image ) ) :
			$finalmage = '<figure class="widget-feat-content">';
			if ( !empty( $href ) ) {
				$finalmage .= '<a title="'.$title.'" href="'.$href .'" target="'.$base.'"><img class="wp-post-image" alt="'.$title.'" src="'.esc_url( $image ).'" /></a>'; 
			}
			else {
				$finalmage .= '<img class="wp-post-image" alt="'.$title.'" src="'.esc_url( $image ).'" />';
			}
			$finalmage .= '</figure>';
		else:
			$finalmage = '';
		endif;


		if ( $content != '' ) {
			$finalcontent = '<div class="textwidget feat-content">'.$content.'</div>';
		} else {
			$finalcontent = '';
		}
		
		//Print it
		echo $before_widget;
		
		
		if ( $image_position == 'above' ) {
			echo $finalmage;
			echo $finaltitle;
		}
		else {
			echo $finaltitle;
			echo $finalmage;
		}
		
		echo $finalcontent;
		
		echo $after_widget;
	}

} 


/**
 * Makes a custom Widget for Featured Page
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */
class catcheverest_page_widget extends WP_Widget {
		
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function catcheverest_page_widget() {
		$widget_ops = array( 'classname' => 'widget_catcheverest_page_widget', 'description' => __( 'Use this widget to add Page as a widget.', 'catcheverest' ) );
		$this->WP_Widget( 'widget_catcheverest_page_widget', __( '4. Catch Everest: Featued Page', 'catcheverest' ), $widget_ops );
		$this->alt_option_name = 'widget_catcheverest_page_widget';
	}	
	
	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'page_id' => '', 'image' => 'small', 'image_position' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title (Optional): Add in the Title to relace the Page Title', 'catcheverest'); ?></label><br />
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'catcheverest' ); ?>:</label><br />
			<?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'page_id' ), 'selected' => $instance['page_id'] ) ); ?>
		</p>
        
		<!-- Image: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image:', 'catcheverest'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'image' ); ?>">
				<option value="small" <?php if ( 'small' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Small Image Size', 'catcheverest' ); ?></option>
                <option value="featured" <?php if ( 'featured' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Featured Image Size', 'catcheverest' ); ?></option>
				<option value="slider" <?php if ( 'slider' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Slider Image Size', 'catcheverest' ); ?></option>
                <option value="full" <?php if ( 'full' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Full Size Image Size', 'catcheverest' ); ?></option>
                <option value="disable" <?php if ( 'disable' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Disable Image', 'catcheverest' ); ?></option>
			</select>
		</p>              
    
		<!-- Image Position? Checkbox -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['image_position']) ? $instance['image_position'] : 0  ); ?> id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'image_position' ); ?>"><?php _e('Move Image After Title?', 'catcheverest'); ?></label>
		</p> 
                                
	<?php
	}	
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
		$instance[ 'image' ] = $new_instance[ 'image' ];
		$instance['image_position'] = isset($new_instance['image_position']);
	
		return $instance;
	}	
	
	/**
	 * Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */	
	function widget( $args, $instance ) {
 		extract( $args );
 		global $post;
		
 		$title = isset( $instance[ 'title' ] ) ? apply_filters('widget_title', $instance['title'] ) : '';
 		$page_id = isset( $instance[ 'page_id' ] ) ? $instance[ 'page_id' ] : '';
 		$image = $instance[ 'image' ];
		$image_position = isset( $instance['image_position'] ) ? $instance['image_position'] : false;

 		if( $page_id ) {
 			$the_query = new WP_Query( 'page_id='.$page_id );
 			while( $the_query->have_posts() ):$the_query->the_post();
 			
				// Title
				$finaltitle = $before_title;
				
				$page_name = the_title( '', '', false );
				
				if ( !empty( $title ) ) {
					$finaltitle .= '<a title="'.$title.'" href="' . get_permalink() . '">'.$title.'</a>'; 
					$showtitle = $title;
				}
				else {
					$finaltitle .= '<a title="'.$page_name.'" href="' . get_permalink() . '">'.$page_name.'</a>'; 
					$showtitle = $page_name;
				}
				$finaltitle .= $after_title;
				
				// Image
				if ( has_post_thumbnail() && $image != "disable" ) {
					$finalmage = '<figure class="widget-feat-content"><a href="' . get_permalink() . '" title="'.$showtitle.'">';
					
					if ( $image == "small" ) {
	 					$finalmage .= get_the_post_thumbnail( $post->ID, 'small-featured', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
	 				}
					elseif ( $image == "featured" ) {
	 					$finalmage .= get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
	 				}
					elseif ( $image == "slider" ) {
	 					$finalmage .= get_the_post_thumbnail( $post->ID, 'slider', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
	 				}
					else {
						$finalmage .= get_the_post_thumbnail( $post->ID, 'full', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
					}
	 			
					$finalmage .= '</a></figure>';
				}
				else $finalmage = '';
				
				
				echo $before_widget;
				
				if ( $image_position == "true" ) {
					echo $finaltitle;
					echo $finalmage;
					
				}
				else {
					echo $finalmage;
					echo $finaltitle;
				}
				
				//Get Excerpt
				$catcheverest_excerpt = get_the_excerpt();
				
				//More Tag
				global $catcheverest_options_settings;
				$options = $catcheverest_options_settings;
				$moretag = $options[ 'more_tag_text' ];
				
				if ( !empty( $catcheverest_excerpt ) ) : ?>
                    <div class="textwidget feat-page entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->     
				<?php else : ?>
                    <div class="textwidget feat-page entry-content">
                        <?php the_content( $moretag ); ?>
                    </div><!-- .entry-content -->
                <?php endif; ?>
				
                <?php echo $after_widget;
				
	 		endwhile;
	 		// Reset Post Data
	 		wp_reset_postdata();
 		}	
 	}	
	
}


/**
 * Makes a custom Widget for Featured Post
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Catch Themes
 * @subpackage Catch_Everest
 * @since Catch Everest 1.0
 */
class catcheverest_post_widget extends WP_Widget {
		
	/**
	 * Constructor
	 *
	 * @return void
	 **/
	function catcheverest_post_widget() {
		$widget_ops = array( 'classname' => 'widget_catcheverest_post_widget', 'description' => __( 'Use this widget to add Post as a widget.', 'catcheverest' ) );
		$this->WP_Widget( 'widget_catcheverest_post_widget', __( '5. Catch Everest: Featued Post', 'catcheverest' ), $widget_ops );
		$this->alt_option_name = 'widget_catcheverest_post_widget';
	}	
	
	/**
	 * Creates the form for the widget in the back-end which includes the Title , adcode, image, alt
	 * $instance Current settings
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'post_id' => '0', 'image' => 'small', 'image_position' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
        	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title (Optional): Add in the Title to relace the Page Title', 'catcheverest'); ?></label><br />
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Post ID', 'catcheverest' ); ?>:</label>
            <input id="<?php echo $this->get_field_id( 'post_id' ); ?>" class="widefat" type="text" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo $instance['post_id']; ?>" />
		</p>
        
		<!-- Image: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image:', 'catcheverest'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'image' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'image' ); ?>">
				<option value="small" <?php if ( 'small' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Small Image Size', 'catcheverest' ); ?></option>
                <option value="featured" <?php if ( 'featured' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Featured Image Size', 'catcheverest' ); ?></option>
				<option value="slider" <?php if ( 'slider' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Slider Image Size', 'catcheverest' ); ?></option>
                <option value="full" <?php if ( 'full' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Show Full Size Image Size', 'catcheverest' ); ?></option>
                <option value="disable" <?php if ( 'disable' == $instance['image'] ) echo 'selected="selected"'; ?>><?php _e( 'Disable Image', 'catcheverest' ); ?></option>
			</select>
		</p>              
    
		<!-- Image Position? Checkbox -->
		<p>
			<input class="checkbox" type="checkbox" <?php checked(isset( $instance['image_position']) ? $instance['image_position'] : 0  ); ?> id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'image_position' ); ?>"><?php _e('Move Image After Title?', 'catcheverest'); ?></label>
		</p> 
                                
	<?php
	}	
	
	/**
	 * update the particular instant  
	 * 
	 * This function should check that $new_instance is set correctly.
	 * The newly calculated value of $instance should be returned.
	 * If "false" is returned, the instance won't be saved/updated.
	 *
	 * $new_instance New settings for this instance as input by the user via form()
	 * $old_instance Old settings for this instance
	 * Settings to save or bool false to cancel saving
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'post_id' ] = absint( $new_instance[ 'post_id' ] );
		$instance[ 'image' ] = $new_instance[ 'image' ];
		$instance['image_position'] = isset($new_instance['image_position']);
	
		return $instance;
	}	
	
	/**
	 * Displays the Widget in the front-end.
	 * 
	 * $args Display arguments including before_title, after_title, before_widget, and after_widget.
	 * $instance The settings for the particular instance of the widget
	 */	
	function widget( $args, $instance ) {
 		extract( $args );
 		global $post;
		
 		$title = isset( $instance[ 'title' ] ) ? apply_filters('widget_title', $instance['title'] ) : '';
 		$post_id = isset( $instance[ 'post_id' ] ) ? $instance[ 'post_id' ] : '';
 		$image = $instance[ 'image' ];
		$image_position = isset( $instance['image_position'] ) ? $instance['image_position'] : false;

 		if( $post_id ) {
 			$the_query = new WP_Query( 'p='.$post_id );
 			while( $the_query->have_posts() ):$the_query->the_post();
		
				// Title
				$finaltitle = $before_title;
				
				$page_name = the_title( '', '', false );
				
				if ( !empty( $title ) ) {
					$finaltitle .= '<a title="'.$title.'" href="' . get_permalink() . '">'.$title.'</a>'; 
					$showtitle = $title;
				}
				else {
					$finaltitle .= '<a title="'.$page_name.'" href="' . get_permalink() . '">'.$page_name.'</a>'; 
					$showtitle = $page_name;
				}
				$finaltitle .= $after_title;
				
				// Image
				if ( has_post_thumbnail() && $image != "disable" ) {
					$finalmage = '<figure class="widget-feat-content"><a href="' . get_permalink() . '" title="'.$showtitle.'">';
					
					if ( $image == "small" ) {
	 					$finalmage .= get_the_post_thumbnail( $post->ID, 'small-featured', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
	 				}
					elseif ( $image == "featured" ) {
	 					$finalmage .= get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
	 				}
					elseif ( $image == "slider" ) {
	 					$finalmage .= get_the_post_thumbnail( $post->ID, 'slider', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
	 				}
					else {
						$finalmage .= get_the_post_thumbnail( $post->ID, 'full', array( 'title' => esc_attr( $showtitle ), 'alt' => esc_attr( $showtitle ) ) );
					}
	 			
					$finalmage .= '</a></figure>';
				}
				else $finalmage = '';
				
				
				echo $before_widget;
				
				if ( $image_position == "true" ) {
					echo $finaltitle;
					echo $finalmage;
					
				}
				else {
					echo $finalmage;
					echo $finaltitle;
				}
				
				//Get Excerpt
				$catcheverest_excerpt = get_the_excerpt();
				
				//More Tag
				global $catcheverest_options_settings;
				$options = $catcheverest_options_settings;
				$moretag = $options[ 'more_tag_text' ];
				
				//Content
				if ( !empty( $catcheverest_excerpt ) ) : ?>
                    <div class="textwidget feat-page entry-summary">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-summary -->     
				<?php else : ?>
                    <div class="textwidget feat-page entry-content">
                        <?php the_content( $moretag ); ?>
                    </div><!-- .entry-content -->
                <?php endif; ?>
				
                <?php echo $after_widget;
				
	 		endwhile;
	 		// Reset Post Data
	 		wp_reset_postdata();
 		}	
 	}	
	
}