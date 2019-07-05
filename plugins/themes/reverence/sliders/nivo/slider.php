<?php
	$al_options = get_option('al_general_settings'); 
	$loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
?>

<script type="text/javascript">
	  jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({
			//controlNavThumbs: true,
        	effect:'<?php echo $al_options['nivo_effect']?>',
        	slices:<?php echo $al_options['nivo_slices']?>,
        	animSpeed:<?php echo $al_options['nivo_speed']?>,
        	pauseTime:<?php echo $al_options['nivo_pause']?>,
        	directionNav:<?php echo $al_options['nivo_direction']?>,
        	controlNav:<?php echo $al_options['nivo_controlnav']?>,
        	keyboardNav:<?php echo $al_options['nivo_keynav']?>
        });
    });
</script>

<div class="nivo_container">
    <div id="slider" class="nivoSlider theme-default">
    
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<?php	
				$custom = get_post_custom($post->ID);
				$link = isset ($custom['_slider_link']) ? $custom['_slider_link'][0] : ''; 
				$image_id = get_post_thumbnail_id();  
				$image_url = wp_get_attachment_image_src($image_id,'full'); 
				//$thumb_url = wp_get_attachment_image_src($image_id,'thumbnail'); 
			?>
			<?php if ($link !== ''):?><a href="<?php echo $link ?>"><?php endif?>
				<img src="<?php echo $image_url[0]?>" alt="" title="#htmlcaption<?php echo $post->ID?>"  />
			<?php if ($link !== ''):?></a><?php endif?>	
			
	    <?php endwhile; ?>    
    </div>
	
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div id="htmlcaption<?php echo $post->ID?>" class="nivo-html-caption">
			<p><?php the_title()?>	</p>
			<?php //the_content() ?>
		</div>
	<?php endwhile; ?>    	
	
 </div>
        
<div class="clearnospacing"></div>
