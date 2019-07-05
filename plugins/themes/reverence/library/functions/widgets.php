<?php

/**** WIDGETS AREA ****/


/* ***************************************************** 
 * Plugin Name: Reverence Flickr
 * Description: Retrieve and display photos from Flickr.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class al_flickr_widget extends WP_Widget {

	// Widget setup.
	function al_flickr_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_al_flickr',
			'description' => __('Display images from flickr', 'Reverence')
		);

		// Widget control settings.
		$control_ops = array(
			'id_base' => 'al-flickr-widget'
		);

		// Create the widget.
		$this->WP_Widget('al-flickr-widget', __('Reverence - Flickr images', 'Reverence') , $widget_ops, $control_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$id = $instance['flickr_id'];
		$nr = ($instance['flickr_nr'] != '') ? $nr = $instance['flickr_nr'] : $nr = 16;
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo "
		<script type=\"text/javascript\">
			jQuery(document).ready(function(){
				jQuery('ul#basicuse').jflickrfeed({
					limit: ".$nr.",
					qstrings: {
						id: '".$id."'
					},
					itemTemplate: '<li><a href=\"http://www.flickr.com/photos/".$id."\"><img src=\"{{image_s}}\" alt=\"{{title}}\" /></a></li>'
				});
			});
		</script>";
		echo '<ul id="basicuse" class="thumbs"><li></li></ul>'.$after_widget;
		
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);
		$instance['flickr_nr'] = strip_tags($new_instance['flickr_nr']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
		'title' => 'Latest From Flickr',
		'flickr_nr' => '16',
		'flickr_id' => '47445714@N03'
		);
		
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'Reverence'); ?></label>
			<input id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
        
		<p>
			<label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('flickr_id'); ?>" type="text" name="<?php echo $this->get_field_name('flickr_id'); ?>" value="<?php echo $instance['flickr_id']; ?>" class="widefat" />
            <small style="line-height:12px;"><a href="http://www.idgettr.com">Find your Flickr user or group id</a></small>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('flickr_nr'); ?>"><?php _e('Number of photos:', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('flickr_nr'); ?>" type="text" name="<?php echo $this->get_field_name('flickr_nr'); ?>" value="<?php echo $instance['flickr_nr']; ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('al_flickr_widget');


/* ***************************************************** 
 * Plugin Name: Last Tweets
 * Description: Displays Latest Tweets.
 * Version: 1.1
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */

add_action( 'widgets_init', 'es_tweets_widgets' );

function es_tweets_widgets() {
	register_widget( 'ES_Tweet_Widget' );
}
class es_tweet_widget extends WP_Widget {

	function ES_Tweet_Widget() {
	
		$widget_ops = array( 'classname' => 'es_tweet_widget', 'description' => __('A custom widget for displaying your latest tweets.', 'Reverence') );
		$this->WP_Widget( 'es_tweet_widget', __('Reverence - Latest Tweets','Reverence'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$username = $instance['username'];
		$postcount = $instance['postcount'];
	
		echo $before_widget;

		if ( $title )
			echo $before_title . $title . '<span class="twitbird">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>'.$after_title;
		
		 ?>
        	<ul id="twitter_update_list" class="twitter">
                <li></li>
            </ul>
            <a href="http://twitter.com/<?php echo $username ?>" class="twitter-link"></a>
			<script type="text/javascript" src="<?php echo get_template_directory_uri()  ?>/js/twitter.js"></script>
			<script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline/<?php echo $username ?>.json?callback=twitterCallback2&amp;count=<?php echo $postcount ?>"></script>
		
		<?php 

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['postcount'] = strip_tags( $new_instance['postcount'] );
		
		return $instance;
	}
	
	function form( $instance ) {

		$defaults = array(
		'title' => 'Latest Tweets',
		'username' => 'mariam_mel',
		'postcount' => '5',
		'tweettext' => 'Follow on Twitter',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'Reverence') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</div>

		<div>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter Username (e.g., weblusive)', 'Reverence') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
		</div>
		
		<div>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of tweets (Keep < 20)', 'Reverence') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</div>
		
	<?php
	}
}



/* ***************************************************** 
 * Plugin Name: Reverence Last Works
 * Description: Retrieve and display latest works (Portfolio).
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class al_works_widget extends WP_Widget {

	// Widget setup.
	function al_works_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_al_works',
			'description' => __('Display latest works (Portoflio)', 'Reverence')
		);

		// Create the widget.
		$this->WP_Widget('al-works-widget', __('Reverence - Latest Works', 'Reverence') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$category = $instance['post_category'];
		
		$args = array('post_type' => 'portfolio', 'taxonomy'=> 'portfolio_category', 'posts_per_page' => $post_count);
		if (!empty($category))
		$args['term'] = $category; 
		$loop = new WP_Query($args);
		?>
        
        
        <ul class="list-posts">
			<?php while ( $loop->have_posts() ) : $loop->the_post();?>
                <li>
                   <div class="list-post-thumb">
                        <a href="<?php the_permalink()?>">
                            <?php if(has_post_thumbnail()):?>
                                <?php the_post_thumbnail('blog-thumb', array('class'=>'cover') ); ?>
                            <?php else:?>
                                <img src = "<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="No Image" />
                            <?php endif?>
                        </a>
                    </div>      
                    <div class="list-post-desc">
                  
                        <a href="<?php the_permalink()?>"><?php the_title() ?></a>
                        <br />
                        <?php echo limit_words(get_the_excerpt(), '12')?>
                    </div>
                    <div class="clear"></div>
                   <!-- <p><?php //echo limit_words($loop->post_content, '12')?></p>-->
                </li>
            <?php endwhile;?>
        </ul>
		<?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Recent works',
			'post_count' => '3',
			'post_category' => '',
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e('Title', 'Reverence'); ?></label>
			<input id="<?php echo $this->get_field_id('post_title'); ?>" type="text" name="<?php echo $this->get_field_name('post_title'); ?>" value="<?php echo $instance['post_title']; ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e('Category', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_category'); ?>" type="text" name="<?php echo $this->get_field_name('post_category'); ?>" value="<?php echo $instance['post_category']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of Posts to show', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_count'); ?>" type="text" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $instance['post_count']; ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('al_works_widget');



/* ***************************************************** 
 * Plugin Name: Reverence Blog Posts
 * Description: Retrieve and display latest blog posts.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class al_blogposts_widget extends WP_Widget {

	// Widget setup.
	function al_blogposts_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_al_blogposts',
			'description' => __('Display latest blog posts', 'Reverence')
		);

		// Create the widget.
		$this->WP_Widget('al-blogposts-widget', __('Reverence Latest Blog Posts', 'Reverence') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$post_category = $instance['post_category'];
		
		global $post;
		$args = array( 'numberposts' => $post_count);
		if (!empty($post_category))
		$args['category'] = $post_category;
		$myposts = get_posts( $args );
		?>
		<ul class="list-posts">
			<?php if ($myposts):
                foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
                    <li>
                        <div class="list-post-thumb">
                            <a href="<?php the_permalink()?>">
                                <?php if(has_post_thumbnail()):?>
									<?php the_post_thumbnail('blog-thumb', array('class'=>'cover') ); ?>
                                <?php else:?>
                                	<img src = "<?php echo get_template_directory_uri()?>/images/picture_small.jpg" alt="No Image" />
                                <?php endif?>
                            </a>
                        </div>      
                        <div class="list-post-desc">
                            <a href="<?php the_permalink()?>"><?php the_title()?></a>
                            <br /><?php echo the_time('F jS, Y') ?>
                            <br />By <?php echo the_author() ?>
                        </div>        
                        <div class="clear"></div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Latest from the blog',
			'post_count' => '2',
			'post_category' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e('Title', 'Reverence'); ?></label>
			<input id="<?php echo $this->get_field_id('post_title'); ?>" type="text" name="<?php echo $this->get_field_name('post_title'); ?>" value="<?php echo $instance['post_title']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of Posts to show', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_count'); ?>" type="text" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $instance['post_count']; ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e('Category (Leave Blank to show from all categories)', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_category'); ?>" type="text" name="<?php echo $this->get_field_name('post_category'); ?>" value="<?php echo $instance['post_category']; ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('al_blogposts_widget');



/* ***************************************************** 
 * Plugin Name: 3-in-1 Posts
 * Description: Retrieve and display popular/latest posts/latest comments.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
class al_totalposts_widget extends WP_Widget {

	// Widget setup.
	function al_totalposts_widget() {

		// Widget settings.
		$widget_ops = array(
			'classname' => 'widget_al_totalposts',
			'description' => __('Retrieve and display popular/latest posts/latest comments.', 'Reverence')
		);

		// Create the widget.
		$this->WP_Widget('al-totalposts-widget', __('Reverence Popular/Latest posts/Last comments', 'Reverence') , $widget_ops);
	}

	// Display the widget on the screen.
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['post_title']);
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		$post_count = $instance['post_count'];
		$post_category = $instance['post_category'];
		
		global $post;
		$args = array( 'numberposts' => $post_count);
		if (!empty($post_category))
		$args['category'] = $post_category;
		?>
		<ul class="tabs tabs-widget">
			<li><a class="" href="#"><?php _e('Popular', 'Reverence')?></a></li>
			<li><a class="" href="#"><?php _e('Recent', 'Reverence')?></a></li>
			<li><a class="" href="#"><?php _e('Comments', 'Reverence')?></a></li>
		</ul>
        <div class="clear"></div>
		<div class="panes panes-widget">
			<div class="pane">				
				<ul class="widget-post-list">
					<?php $myposts = get_posts( $args ); if ($myposts):
						foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
							<li>
								<div class="wpl-image">
									<a href="<?php the_permalink()?>">
										<?php if(has_post_thumbnail()):?>
											<?php the_post_thumbnail('blog-thumb2', array('class'=>'cover') ); ?>
										<?php else:?>
											<img src = "<?php echo get_template_directory_uri()?>/images/picture_small.jpg" alt="<?php _e('No image available', 'Reverence')?>" />
										<?php endif?>
									</a>
								</div>      
								<div class="wpl-desc">
									<a href="<?php the_permalink()?>"><?php the_title()?></a>
									<?php echo limit_words(get_the_excerpt(), 5) ?>
								</div>        
								<div class="clear"></div>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div class="pane">				
				<ul class="widget-post-list">
					<?php 
						$args ['orderby'] = 'comment_count';
						$myposts = get_posts( $args ); 
						
						if ($myposts):
						foreach( $myposts as $post ) :	setup_postdata($post);  ?>                 
							<li>
								<div class="wpl-image">
									<a href="<?php the_permalink()?>">
										<?php if(has_post_thumbnail()):?>
											<?php the_post_thumbnail('blog-thumb2', array('class'=>'cover') ); ?>
										<?php else:?>
											<img src = "<?php echo get_template_directory_uri()?>/images/picture_small.jpg" alt="No Image" />
										<?php endif?>
									</a>
								</div>      
								<div class="wpl-desc">
									<a href="<?php the_permalink()?>"><?php the_title()?></a>
									<?php echo limit_words(get_the_excerpt(), 5) ?>
								</div>        
								<div class="clear"></div>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<div class="pane">				
				<ul class="widget-post-list">
					<?php 
					global $wpdb;	
					$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,70) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT 5";
					$comments = $wpdb->get_results($sql);
					foreach ($comments as $comment) :?>
						<li>
							<div class="wpl-image avatar-listing">
								<a href="<?php echo get_permalink($comment->ID).'#comment-'.$comment->comment_ID?>" title="<?php echo strip_tags($comment->comment_author).' '.__('on ', 'Reverence').' '.$comment->post_title?>">
									<?php echo get_avatar($comment, '45')?>
								</a>
							</div>
							<div class="wpl-desc">
								<a href="<?php echo get_permalink($comment->ID).'#comment-'.$comment->comment_ID?>" title="<?php echo strip_tags($comment->comment_author).' '.__('on', 'Reverence').' '.$comment->post_title?>">
									<?php echo strip_tags($comment->comment_author)?>
								</a>
								<?php echo limit_words(strip_tags($comment->com_excerpt), 6);  ?>
							</div>
							<div class="clear"></div>
						</li>
					<?php endforeach; wp_reset_query();?>			
				</ul>
			</div>
		</div>
        <?php echo $after_widget; 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['post_title'] = strip_tags($new_instance['post_title']);
		$instance['post_count'] = strip_tags($new_instance['post_count']);
		$instance['post_category'] = strip_tags($new_instance['post_category']);
		return $instance;
	}

	function form($instance) {
		$defaults = array(
			'post_title' => 'Blog posts',
			'post_count' => '3',
			'post_category' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('post_title'); ?>"><?php _e('Title', 'Reverence'); ?></label>
			<input id="<?php echo $this->get_field_id('post_title'); ?>" type="text" name="<?php echo $this->get_field_name('post_title'); ?>" value="<?php echo $instance['post_title']; ?>" class="widefat" />
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of Posts to show', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_count'); ?>" type="text" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $instance['post_count']; ?>" class="widefat" />
		</p>
        
         <p>
			<label for="<?php echo $this->get_field_id('post_category'); ?>"><?php _e('Category (Leave Blank to show from all categories)', 'Reverence'); ?></label> 
			<input id="<?php echo $this->get_field_id('post_category'); ?>" type="text" name="<?php echo $this->get_field_name('post_category'); ?>" value="<?php echo $instance['post_category']; ?>" class="widefat" />
		</p>
	<?php
	}
}

register_widget('al_totalposts_widget');


/* ***************************************************** 
 * Plugin Name: Reverence Contact Widget
 * Description: Display contact widget on footer.
 * Version: 1.0
 * Author: Weblusive
 * Author URI: http://www.weblusive.com
 * ************************************************** */
/**
 * Contact Form Widget Class
 */
class al_Contact_Form extends WP_Widget {
	
	function al_Contact_Form() {
		$widget_ops = array('classname' => 'al_contact_form_entries', 'description' => __("Contact widget", 'Reverence') );
		$this->WP_Widget('al_Contact_Form', __('Reverence - Contact Form', 'Reverence'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'Reverence') : $instance['title'], $instance);
		$email = apply_filters('widget_title', empty($instance['email']) ? __('', 'Reverence') : $instance['email'], $instance);
		$success = apply_filters('widget_title', empty($instance['success']) ? __('Thank you, e-mail sent.', 'Reverence') : $instance['success'], $instance);
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

			echo '<form action="#" method="post" id="contactFormWidget">';
			echo '<div><label for="wname" class="required">'.__('Name', 'Reverence').'</label><input type="text" name="wname" id="wname" value="" size="22" /></div>';
			echo '<div><label for="wemail" class="required email">'.__('Email', 'Reverence').'</label><input type="text" name="wemail" id="wemail" value="" size="22" /></div>';
			echo '<div><label for="wmessage" class="required">'.__('Message', 'Reverence').'</label><textarea name="wmessage" id="wmessage" cols="60" rows="10"></textarea></div>';
			echo '<div class="loading"></div>';
			echo '<div><input type="hidden" name="wcontactemail" id="wcontactemail" value="'.$email.'" /></div>';
			echo '<div><input type="hidden" value="'.home_url().'" id="wcontactwebsite" name="wcontactwebsite" /></div>';
			echo '<div><input type="hidden" name="wcontacturl" id="wcontacturl" value="'.get_template_directory_uri().'/library/sendmail.php" /></div>';
			echo '<div style="text-align:right"><input type="submit" id="wformsend" value="'.__('Send message', 'Reverence').'" class="button" name="wsend"  /></div>';
			echo '<div class="clear"></div>';
			echo '<div class="widgeterror"></div>';
			echo '<div class="widgetinfo">'.$success.'</div>';
			echo '</form>';
	
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['success'] = strip_tags($new_instance['success']);
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$success = isset($instance['success']) ? esc_attr($instance['success']) : '';
	?>
	
		<div>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:<br />', 'Reverence'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		</div>
        <div>
        	<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email Address:<br />', 'Reverence'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label></p>
		</div>
        <div>
        	<label for="<?php echo $this->get_field_id('success'); ?>"><?php _e('Success Message:<br />', 'Reverence'); ?>
			<input class="widefat" id="<?php echo $this->get_field_id('success'); ?>" name="<?php echo $this->get_field_name('success'); ?>" type="text" value="<?php echo $success; ?>" /></label></p>
		</div>
		<div style="clear:both"></div>
<?php
	}
}

register_widget('al_Contact_Form');
?>