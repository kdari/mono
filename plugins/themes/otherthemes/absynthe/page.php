<?php get_header() ?>    
		<div id="main" class="clearfix">
			<div id="content">
			  <div class="inner">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('mainbg'); ?>>
						<h1 class="post"><?php the_title(); ?></h1>
							<div class="bottombg">
                <div class="buffer">
				    		  <?php the_content(); ?>
                </div>
						  </div>
				  </div>
			<?php endwhile; ?>
			
			<?php else : ?>
			  <div class="main">
					<h1>Not Found</h1>
					<p>Sorry, but you are looking for something that isn't here.</p>
					<?php include (TEMPLATEPATH . "/searchform.php"); ?>
					<div class="postmeta"></div>
				</div>
			<?php endif; ?>
			</div>
    </div>
	<?php get_sidebar() ?>
    <div class="clearboth"></div>
    </div>
<?php get_footer() ?>