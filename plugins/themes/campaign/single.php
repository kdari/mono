<?php get_header(); ?>
<div id="page" class="posts-wrap">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="post-single" <?php post_class(); ?>>
		<h3 class="entry-title">
			<?php the_title(); ?>
		</h3>
		<?php if ((get_post_meta($post->ID, '_dc_media_vimeo', true) != '') || (get_post_meta($post->ID, '_dc_media_youtube', true) != '')) { ?>
			<?php if (get_post_meta($post->ID, '_dc_media_vimeo', true) != '') { ?>
		<div class="vid-wrap">
			<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, '_dc_media_vimeo', true);?>?portrait=0" width="600" height="335" frameborder="0"></iframe>
		</div>
			<?php } elseif (get_post_meta($post->ID, '_dc_media_youtube', true) != '') { ?>
		<div class="vid-wrap">
			<iframe width="600" height="335" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, '_dc_media_youtube', true);?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>
		</div>
			<?php } ?>
		<?php } elseif (has_post_thumbnail()) { ?>
		<?php } ?>
		<div class="post_meta">
			<div class="blocks_wrap">
				<div class="meta_block">
					<span><?php _e("Post Date", "designcrumbs"); ?></span>
					<?php the_time('F d, Y'); ?>
				</div>
				<div class="meta_block">
					<span><?php _e("Comments", "designcrumbs"); ?></span>
					<?php comments_popup_link( __( '0 Comments', 'designcrumbs' ), __( '1 Comment', 'designcrumbs' ), __( '% Comments', 'designcrumbs' ), 'comments-link', __('Comments Closed', 'designcrumbs')); ?>
				</div>
				<div class="meta_block">
					<span><?php _e("Author", "designcrumbs"); ?></span>
					<?php the_author_posts_link(); ?>
				</div>
				<div class="meta_block">
					<span><?php _e("Category", "designcrumbs"); ?></span>
					<?php the_category(', ') ?>
				</div>
				<div class="meta_block share">
					<span><?php _e("Share", "designcrumbs"); ?></span>
					<a class="share-facebook" onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/socnets/share_facebook.png" alt="Share on Facebook" />
					</a>
					<a class="share-twitter" onclick="window.open('http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>','twitter','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" href="http://twitter.com/home?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/socnets/share_twitter.png" alt="Share on Twitter" />
					</a>
					<a class="share-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','gplusshare','width=450,height=300,left='+(screen.availWidth/2-375)+',top='+(screen.availHeight/2-150)+'');return false;" title="<?php the_title(); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/socnets/share_google.png" alt="Share on Google+" />
					</a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="blog-content">
			<div class="entry-content" id="entry-content-single">
				<?php the_content(); ?>
				<div class="clear"></div>
				<?php if (has_tag()) { ?>
				<div class="single-meta">
					<?php the_tags( __('Tagged with ', 'designcrumbs'), ", ", " " ) ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="clear"></div>
		<?php my_author_box(); ?>
	</div><!-- end .post -->		
			
			<?php comments_template('', true); ?>
	
		<?php endwhile; else: ?>

			<?php _e('Sorry, no posts matched your criteria', 'designcrumbs'); ?>.

		<?php endif; ?>
	<div class="clear"></div>
</div><!-- end .posts-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>