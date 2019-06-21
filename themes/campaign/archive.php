<?php get_header(); ?>
<div class="posts-wrap the_blog">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div <?php post_class('blog-home-post'); ?> id="post-<?php the_ID(); ?>">
		<div class="post_content">
			<h2 class="post_title index-entry-title">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
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
			<a href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'full', true); echo $image_url[0]; ?>" class="lightbox"><?php the_post_thumbnail( 'blog_image', array('alt' => get_the_title()) ); ?></a>
			<?php } ?>
			<div class="post_meta">
				<div class="blocks_wrap">
					<div class="meta_block">
						<span><?php _e("Post Date", "designcrumbs"); ?></span>
						<?php the_time(get_option( 'date_format' )); ?>
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
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="more-link"><?php _e("Read More", "designcrumbs"); ?> &raquo;</a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div><!-- end .post -->
        
		<?php endwhile; ?>
	<div class="navigation">
		<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'designcrumbs')) ?></div>
		<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'designcrumbs')) ?></div>
		<div class="clear"></div>
	</div>

	<?php else : ?>
	<h3><?php _e("Sorry!", "designcrumbs"); ?></h3>
	<div class="search-404">
		<?php _e("There are no posts in this category yet. Please try another link.", "designcrumbs"); ?>
	</div>
        
	<?php endif; ?>
</div><!-- end .posts-wrap -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>