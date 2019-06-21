<?php get_header(); ?>

	<div id="content">
    	<div class="container">
			<div id="sidebar">
				<?php include (TEMPLATEPATH . '/left-sidebar.php'); ?>
            </div>
            <div id="main">
            	<h2>Error 404 page</h2>
				<p>the content you want to see is gone. how did this happend click <a href="<?php echo get_option('home'); ?>/">here.</a></p>
            </div>
        </div>	
	</div><!--/content-->

<?php get_footer(); ?>