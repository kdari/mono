<?php get_header(); 
	global $data;?>
	<div id="content">
		<div id="content-left">
			<div id="main-content"  role="main">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix post'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header>
							<h1 class="single-title replace" itemprop="headline"><?php the_title(); ?></h1>
						</header> <!-- end article header -->

						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_post_thumbnail('single-post-thumbnail'); ?>
							<?php the_content(); ?>
						</section> <!-- end article section -->

						<footer>
							<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
							<p class="meta"><?php _e("Posted", "lop"); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "lop"); ?> <?php the_author_posts_link(); ?> <?php _e("in", "lop"); ?> <?php the_category(', '); ?> <?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>
                             
							 <?php if ( $data['lop_addthis_bar'] == 1 ) {  lop_addthis();  } ?>

							
						</footer> <!-- end article footer -->

					</article> <!-- end article -->
					<div class="clear"></div>


					<?php comments_template(); ?>
				<?php endwhile; else: ?>
					<article id="post-not-found">
					    <header>
					    	<h1><?php __('Not Found','lop') ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php __('Sorry, but the requested resource was not found on this site.','lop') ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
				<?php endif; ?>
				</div>
			</div><!-- end main content -->
		</div><!-- end content-left -->

		<div id="content-right">
		<?php get_sidebar(); ?>
		</div>
	</div>
	<!--content end-->

    </div>
    <!--main end-->
</div>
<!--wrapper end-->
<div class="clear"></div>
<?php get_footer(); ?>