	<?php get_header(); ?>

		<div id="content">

			<div id="content-left">

				<div id="main-content">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix post'); ?>>

	      					<header>
	        					<h2><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a> &raquo; <?php the_title(); ?></h2>
	      					</header>

	      					<section class="post_content clearfix">
	      						<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
	      						<p class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></p>

	      						<?php the_content(); ?>
	      					</section>

	      					<footer>
	      					</footer>
	    				</article>

					<?php endwhile; else: ?>
	    				<div class="help">
	    					<p><?php __('Sorry, no attachments matched your criteria.','lop') ?></p>
	    				</div>
					<?php endif; ?>

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