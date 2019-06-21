<?php
$al_options = get_option('al_general_settings'); 
$loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
?>

<script type="text/javascript">		
	jQuery(document).ready(function(){
		jQuery('#ei-slider').eislideshow({
			easing		: '<?php echo isset($al_options['al_ei_easing']) ? $al_options['al_ei_easing'] : 'easeOutExpo' ?>',
			titleeasing	: '<?php echo isset($al_options['al_ei_titleasing']) ? $al_options['al_ei_titleasing'] : 'easeOutExpo' ?>',
			titlespeed	: <?php echo isset($al_options['al_ei_titlespeed']) ? $al_options['al_ei_titlespeed'] : '1200' ?>,
			autoplay: <?php echo isset($al_options['al_ei_autoplay']) ? $al_options['al_ei_autoplay'] : 'true' ?>,
			slideshow_interval	: <?php echo isset($al_options['al_ei_interval']) ? $al_options['al_ei_interval'] : '3000' ?>,
			speed	: <?php echo isset($al_options['al_ei_anispeed']) ? $al_options['al_ei_anispeed'] : '800' ?>
		
		});		
	});
</script>

<!-- BEGIN Slider -->
<div id="slider-wrapper">

     <div id="ei-slider" class="ei-slider">

        <ul class="ei-slider-large">
        	<?php while ( $loop->have_posts() ) : 
				$loop->the_post();            
				$custom = get_post_custom($post->ID);
				
				$link = (isset($custom['_slider_link'][0])) ? $custom['_slider_link'][0] : '';
				
				$image_id = get_post_thumbnail_id();  
				$image_url = wp_get_attachment_image_src($image_id,'full'); 
				?>		
				<li>
                	<?php if ($link !== ''):?><a href="<?php echo $link?>"><?php endif?>
                	<img src="<?php echo $image_url[0]?>" alt="" />
                    <?php if ($link !== ''):?></a><?php endif?>
                </li>
            <?php endwhile; ?>             
        </ul><!-- ei-slider-large -->

        <ul class="ei-slider-thumbs">
            <li class="ei-slider-element">Current</li>
            <?php 
				while ( $loop->have_posts() ) : $loop->the_post(); 
				$custom = get_post_custom($post->ID);
				$image_id = get_post_thumbnail_id();  
				$image_url = wp_get_attachment_image_src($image_id,'medium'); 
				$link = (isset($custom['_slider_link'][0])) ? $custom['_slider_link'][0] : '';
			?>       
            <li>
                <a href="<?php echo $link ?>"><?php the_title() ?></a>
				<img src="<?php echo $image_url[0]?>" alt=""  />
            </li>
			<?php endwhile?>
        </ul><!-- ei-slider-thumbs -->
        <div class="clear"></div>
    </div><!-- ei-slider -->
    <div class="clear"></div>
</div>
<div class="clear"></div>

<!-- END Slider -->