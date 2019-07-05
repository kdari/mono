<?php
	$al_options = get_option('al_general_settings'); 
	$loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
?>

<script type="text/javascript">
	jQuery(window).load(function(){  
		jQuery("#flexmain").fitVids().flexslider({
			animation	: '<?php echo isset($al_options['al_flex_animation']) ? $al_options['al_flex_animation'] : 'slide' ?>',
			slideDirection	: '<?php echo isset($al_options['al_flex_slide_direction']) ? $al_options['al_flex_slide_direction'] : 'horizontal' ?>',
			slideshow	: <?php echo isset($al_options['al_flex_slide_auto']) ? $al_options['al_flex_slide_auto'] : 'true' ?>,
			slideshowSpeed	: <?php echo isset($al_options['al_flex_slideshow_speed']) ? $al_options['al_flex_slideshow_speed'] : '7000' ?>,
			animationDuration	: <?php echo isset($al_options['al_flex_animation_duration']) ? $al_options['al_flex_animation_duration'] : '600' ?>,
			useCSS: false,
			controlNav: false, 
			smoothHeight: true,
			start: function(slider){
				jQuery('body').removeClass('loading');
			}
			/*before: function(slider){
				$f(player).api('pause');
			}*/
		});
	});
</script>
<div class="flex-wrapper">
	<div class="flexslider" id="flexmain">
		<ul class="slides">
			 <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php	
					$custom = get_post_custom($post->ID);
					$link = isset ($custom['_slider_link']) ? $custom['_slider_link'][0] : ''; 
					$video = isset ($custom['_slider_video']) ? $custom['_slider_video'][0] : ''; 
					$image_id = get_post_thumbnail_id();  
					$image_url = wp_get_attachment_image_src($image_id,'full'); 
					
				?>
				<li>
					<?php if ($video == ''):?>
						<?php if ($link !== ''):?><a href="<?php echo $link ?>"><?php endif?>
							<img src="<?php echo $image_url[0]?>" alt="" title="#htmlcaption<?php echo $post->ID?>"  />
						<?php if ($link !== ''):?></a><?php endif?>	
					<?php else:?>
						<iframe id="player_<?php echo $post->ID?>" src="http://player.vimeo.com/video/<?php echo $video?>?api=1&amp;player_id=player_<?php echo $post->ID?>" width="920" height="375"></iframe>
					<?php endif ?>
				</li>
			<?php endwhile; ?> 
		</ul>
		<div class="clear"></div>
	</div>
</div>