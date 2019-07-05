  	<!-- Headline Box -->
	<div class="headline_box">
		<div class="middle">
        	<?php
			global $data;
			if ($data['lop_hlbox_title']) { ?>
				<h3 class="replace"><?php echo $data['lop_hlbox_title']; ?></h3>
            <?php }; 
			if ($data['lop_hlbox_text']) { 
				echo stripslashes ($data['lop_hlbox_text']);
            }; ?>
		</div>
		<div class="bottom"></div>
	</div>
	<div id="sidebar">
		<?php if ( is_active_sidebar( 'sidebar-home' ) ) : ?>
			<div class="sidebaritem"><?php dynamic_sidebar( 'sidebar-home' ); ?></div>
		 <?php else : ?>
	        <!-- This content shows up if there are no widgets defined in the backend. -->
	        <div class="help">
	             <p><?php _e('Please activate the widgets from WordPress Dashboard > Appearance > Widgets.','lop') ?></p>
	        </div>
		<?php endif; ?>
	</div><!-- end #sidebar -->