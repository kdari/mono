	<?php get_header(); ?>
		<div id="content">
			<div id="content-left">
				<div id="main-content" role="main">
				
					<article id="post-not-found" class="clearfix">
						
						<header>
							<h1 class="replace"><?php _e("Error 404 - Not Found", "lop"); ?></h1>                   
						</header> <!-- end article header -->
					
						<section class="post_content">
							<p><?php _e("We're sorry, but that page doesn't exist or has been moved.", "lop"); ?></p>
						</section> <!-- end article section -->
						
						<footer>
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
				</div>
			</div>
			<div id="content-right">
				<?php get_sidebar(); ?>
			</div>
        </div>
        <!-- end #content -->
       
    </div>
    <!-- end main-->
</div>
<!--wrapper end-->
<div class="clear"></div>		
<?php get_footer(); ?>