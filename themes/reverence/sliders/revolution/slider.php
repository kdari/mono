<?php
$al_options = get_option('al_general_settings'); 
$loop = new WP_Query( array( 'post_type' => 'slider', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
?>

<script type="text/javascript">
	var tpj=jQuery;
	tpj(document).ready(function() {
		if (tpj.fn.cssOriginal!=undefined) tpj.fn.css = tpj.fn.cssOriginal;
		tpj('.fullwidthbanner').revolution(
		{	
			delay:<?php echo isset ($al_options['al_revolution_interval']) ? $al_options['al_revolution_interval'] : '9000'?>,												
			navigationType:"<?php echo isset ($al_options['al_revolution_pagination']) ? $al_options['al_revolution_pagination'] : 'none'?>",	//bullet, thumb, none, both	 (No Shadow in Fullwidth Version !)
			navigationStyle:"<?php echo isset ($al_options['al_revolution_paginationstyle']) ? $al_options['al_revolution_paginationstyle'] : 'navbar'?>",	//round,square,navbar
			onHoverStop:"<?php echo isset ($al_options['al_revolution_onhoverstop']) ? $al_options['al_revolution_onhoverstop'] : 'off'?>",// Stop Banner Timet at Hover on Slide on/off
			stopLoop:"<?php echo isset ($al_options['al_revolution_stoploop']) ? $al_options['al_revolution_stoploop'] : 'on'?>", // on == Stop loop at the last Slie,  off== Loop all the time.			
			startwidth:890,
			startheight:450,
			thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
			thumbHeight:50,
			thumbAmount:3,
			hideThumbs:200,
			navigationArrows:"verticalcentered",		//nexttobullets, verticalcentered, none
			touchenabled:"on",						// Enable Swipe Function : on/off
			navOffsetHorizontal:0,
			navOffsetVertical:20,
			fullWidth:"on",
			shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)
										
		});	
	});
</script>


<!-- BEGIN Slider -->

<div class="fullwidthbanner-container">					
	<div class="fullwidthbanner">
        <ul>
        	<?php while ( $loop->have_posts() ) : 
				$loop->the_post();            
				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'full'); 
				?>		
				<li data-transition="slideup" data-slotamount="10" data-thumb="<?php echo $image_url[0]?>">	
                	<?php echo get_the_content() ?>
                </li>
            <?php endwhile; ?>             
        </ul>		
        <div class="tp-bannertimer"></div>		
    </div>
</div>
<!-- END Slider -->