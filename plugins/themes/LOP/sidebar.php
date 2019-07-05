<div id="sidebar" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-main' ) ) : ?>
		<div class="sidebaritem"><?php dynamic_sidebar( 'sidebar-main' ); ?></div>

    <?php else : ?>
        <!-- This content shows up if there are no widgets defined in the backend. -->
        <div class="help">
             <p><?php _e('Please activate the widgets from WordPress Dashboard > Appearance > Widgets.','lop') ?></p>
        </div>

	<?php endif; ?>

</div>
<!-- end #sidebar -->