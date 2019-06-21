<?php

	$al_options = get_option('al_general_settings'); 
	$loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
?>

<script type="text/javascript">
	jQuery(function(){
		jQuery('#camera_wrap_1').camera({
			imagePath: '<?php echo get_template_directory_uri() ?>/sliders/camera/images/',
			loaderColor: '#eeeeee',
			loaderBgColor: '#222222',
			autoAdvance: <?php echo isset ($al_options['al_camera_autoadvance']) ? $al_options['al_camera_autoadvance'] : 'true'?>,
			time: <?php echo isset ($al_options['al_camera_interval']) ? $al_options['al_camera_interval'] : '7000'?>,
			transPeriod: <?php echo isset ($al_options['al_camera_ts']) ? $al_options['al_camera_ts'] : '1500'?>,
			thumbnails: <?php echo isset ($al_options['al_camera_thumbnails']) ? $al_options['al_camera_thumbnails'] : 'true'?>,
			barDirection: '<?php echo isset ($al_options['al_camera_bardirection']) ? $al_options['al_camera_bardirection'] : 'leftToRight'?>',
			barPosition: '<?php echo isset ($al_options['al_camera_barposition']) ? $al_options['al_camera_barposition'] : 'bottom'?>',
			easing: '<?php echo isset ($al_options['al_camera_easing']) ? $al_options['al_camera_easing'] : 'easeInOutExpo'?>',
			navigation: <?php echo isset ($al_options['al_camera_navigation']) ? $al_options['al_camera_navigation'] : 'true'?>,
			pagination: <?php echo isset ($al_options['al_camera_pagination']) ? $al_options['al_camera_pagination'] : 'true'?>		
		});
	});
</script>

<div class="fluid_container">
	<div class="camera_wrap camera_black_skin" id="camera_wrap_1">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php	
				$custom = get_post_custom($post->ID);
				$link = isset ($custom['_slider_link']) ? $custom['_slider_link'][0] : ''; 
				$video = isset ($custom['_slider_video']) ? $custom['_slider_video'][0] : ''; 
				$image_id = get_post_thumbnail_id();  
				$image_url = wp_get_attachment_image_src($image_id,'full'); 
				$thumb = wp_get_attachment_image_src($image_id,'thumbnail'); 
			?>
			<div data-thumb="<?php echo $thumb[0] ?>" data-src="<?php echo $image_url[0]?>">
				<?php if ($video == ''):?>
					<div class="camera_caption fadeFromLeft">
					   <?php the_title() ?>
					</div>
				<?php else:?>
					<iframe id="player_<?php echo $post->ID?>" src="http://player.vimeo.com/video/<?php echo $video?>?api=1&amp;player_id=player_<?php echo $post->ID?>" class="vimeo-frame2"></iframe>
				<?php endif ?>
			</div>
		<?php endwhile; ?> 	
	</div>
	<div class="clear"></div>
</div>