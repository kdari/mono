        <div id="popupContact"> <a id="popupContactClose" href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/window-close.png" alt="close window" /></a>
		<!--START PopUP content-->
            	<?php global $data; ?>

                <?php 
				if ( $data['lop_popup_page'] ) { 
				    $page = $data['lop_popup_page'];
					$the_query = new WP_Query( '&posts_per_page=1&page_id='.$page.'' ); 
					while ( $the_query->have_posts() ) : $the_query->the_post();?>
					<h2 class="replace"><?php the_title(); ?></h2>                
					<?php the_content(); ?>
					<?php endwhile; wp_reset_postdata(); 
				} ?>

		<!--END PopUP content-->
        </div>
        <div id="backgroundPopup"></div>	