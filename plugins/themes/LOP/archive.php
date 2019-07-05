	<?php get_header(); ?>
		<div id="content">
			<div id="content-left">
				<div id="main-content" role="main">
            
					<?php if (is_category()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts Categorized:", "lop"); ?></span> <?php single_cat_title(); ?>
						</h1>
					<?php } elseif (is_tag()) { ?> 
						<h1 class="archive_title h2">
							<span><?php _e("Posts Tagged:", "lop"); ?></span> <?php single_tag_title(); ?>
						</h1>
					<?php } elseif (is_author()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts By:", "lop"); ?></span> <?php get_the_author_meta('display_name'); ?>
						</h1>
					<?php } elseif (is_day()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Daily Archives:", "lop"); ?></span> <?php the_time('l, F j, Y'); ?>
						</h1>
					<?php } elseif (is_month()) { ?>
					    <h1 class="archive_title h2">
					    	<span><?php _e("Monthly Archives:", "lop"); ?></span> <?php the_time('F Y'); ?>
					    </h1>
					<?php } elseif (is_year()) { ?>
					    <h1 class="archive_title h2">
					    	<span><?php _e("Yearly Archives:", "lop"); ?></span> <?php the_time('Y'); ?>
					    </h1>
					<?php } ?>
                    
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
	
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix post'); ?> role="article">
							
							<header>
								<h2 class="line"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							</header> <!-- end article header -->
						
							<section class="post_content">
								<?php the_excerpt(); ?>
							</section> <!-- end article section -->
							
							<footer>
	                        	<p class="meta"><time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "lop"); ?> <?php the_author_posts_link(); ?> <?php _e("in", "lop"); ?> <?php the_category(', '); ?></p>
								<p class="meta"><?php comments_popup_link('No comments yet', '1 comment', '% comments', '', 'Comments are disabled for this post'); ?></p>
							</footer> <!-- end article footer -->
						
						</article> <!-- end article -->

					<?php endwhile; ?>
                    
						<nav id="page-nav">
						    <?php next_posts_link(__('&laquo; Previous Entries','lop')) ?>
						    <?php previous_posts_link(__('Next Entries &raquo;','lop')) ?>
						</nav>
                    
					<?php else : ?>
					
						<article id="post-not-found">
						    <header>
						    	<h2><?php _e("No Posts Yet", "lop"); ?></h2>
						    </header>
						    <section class="post_content">
						    	<p><?php _e("Sorry, What you were looking for is not here.", "lop"); ?></p>
						    </section>
						    <footer>
						    </footer>
						</article>

					<?php endif; ?>	
				</div>
                <!-- end #main-content -->
			</div>
            <!-- end #content-left -->

        	<div id="content-right">
				<?php get_sidebar(''); ?>
			</div>
        </div>
        <!-- end #content-->
    </div>
    <!-- end #main-->
</div>
<!--wrapper end-->
<div class="clear"></div>		
<?php get_footer(); ?>