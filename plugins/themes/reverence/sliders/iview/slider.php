<?php
	$al_options = get_option('al_general_settings'); 
	$loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
?>

<script type="text/javascript">
	
	jQuery(document).ready(function(){
		
		jQuery('#iview').iView({
			pauseTime: <?php echo isset ($al_options['al_iview_interval']) ? $al_options['al_iview_interval'] : '7000'?>,
			pauseOnHover: true,
			directionNavHoverOpacity: 0,
			timer: "Bar",
			timerDiameter: "50%",
			timerPadding: 0,
			timerStroke: 7,
			timerBarStroke: 0,
			easing: '<?php echo isset ($al_options['al_iview_easing']) ? $al_options['al_iview_easing'] : 'easeInOutExpo'?>',
			timerColor: "#FFF",
			timerPosition: "bottom-right",
			directionNav: <?php echo isset ($al_options['al_iview_navigation']) ? $al_options['al_iview_navigation'] : 'true'?>, 
			controlNav: <?php echo isset ($al_options['al_iview_pagination']) ? $al_options['al_iview_pagination'] : 'true'?>, 
			autoAdvance: <?php echo isset ($al_options['al_iview_autoadvance']) ? $al_options['al_iview_autoadvance'] : 'true'?>,			
		});
	});
</script>

<div id="iview-wrapper">
	<div id="iview">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php	
				$custom = get_post_custom($post->ID);
				$link = isset ($custom['_slider_link']) ? $custom['_slider_link'][0] : ''; 
				$video = isset ($custom['_slider_video']) ? $custom['_slider_video'][0] : ''; 
				$image_id = get_post_thumbnail_id();  
				$image_url = wp_get_attachment_image_src($image_id,'full'); 
				$thumb = wp_get_attachment_image_src($image_id,'medium'); 
			?>
			<?php if ($video !== ''):?>
				<div data-iview:transition="strip-right-fade,strip-left-fade">
					<iframe id="player_<?php echo $post->ID?>" src="http://player.vimeo.com/video/<?php echo $video?>?api=1&amp;player_id=player_<?php echo $post->ID?>" width="100%" height="100%" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				</div>
			<?php else:?>
				<div data-iview:thumbnail="<?php echo $thumb[0]?>" data-iview:image="<?php echo $image_url[0]?>">
					<div class="iview-caption caption3"  data-x="50" data-y="150" data-transition="expandLeft"><?php echo get_the_title() ?></div>
				</div>
			<?php endif ?>
			
		<?php endwhile; ?> 	
	</div>
	<div class="clear"></div>
</div>
