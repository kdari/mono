<?php get_header(); ?>
	<div id="content">
		<div id="content-left">
			<?php include (TEMPLATEPATH . '/library/header-images.php'); ?>
			<div id="main-content"  role="main">
				<h1 class="archive_title replace"><span><?php _e('Search Results for:','lop') ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix post'); ?> role="article">

						<header>

							<h3 class="line"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>


						</header> <!-- end article header -->

						<section class="post_content">
							<?php the_excerpt(); ?>

						</section> <!-- end article section -->

						<footer>
							<p class="meta"><time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> <?php _e("by", "lop"); ?> <?php the_author_posts_link(); ?> <?php _e("in", "lop"); ?> <?php the_category(', '); ?></p>
						</footer> <!-- end article footer -->

					</article> <!-- end article -->

				<?php endwhile; else: ?>

					<article id="post-not-found">
					    <header>
					    	<h1><?php __('No Results Found','lop') ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php __('Sorry, the page you are looking for was not found on this site.','lop') ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>

				<?php endif; ?>
			</div>
		</div>

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