<?php get_header(); ?>
	<div id="slides_wrap"<?php $sb_count = wp_get_sidebars_widgets(); if (count( $sb_count['Home_Page_Banner']) == '0') { ?> class="home_space"<?php } ?>>
	<div id="slides">
		<div class="slidearea slides_container">
		<?php // START THE SLIDE LOOP ?>
		<?php $loop = new WP_Query( array( 'post_type' => 'slides', 'posts_per_page' => 10, 'order' => 'desc' ) ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div>
			<?php if (has_post_thumbnail()) { ?>
				<div class="slide_image_wrap">
					<?php if (get_post_meta($post->ID, '_dc_slide_text', true) != '') { ?>
					<div class="slide_text_overlay">
						<?php echo get_post_meta($post->ID, '_dc_slide_text', true);?>
					</div>
					<?php } ?>
					<?php if (get_post_meta($post->ID, '_dc_slide_link', true) != '') { ?><a href="<?php echo get_post_meta($post->ID, '_dc_slide_link', true);?>" title="<?php the_title(); ?>"><?php } ?>
						<?php the_post_thumbnail( 'slide_image', array('alt' => get_the_title()) ); ?>
					<?php if (get_post_meta($post->ID, '_dc_slide_link', true) != '') { ?></a><?php } ?>
				</div>
			<?php } else { ?>
				<?php if (get_post_meta($post->ID, '_dc_video_vimeo', true) != '') { ?>
					<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID, '_dc_video_vimeo', true);?>?portrait=0" width="600" height="300" frameborder="0"></iframe>
				<?php } elseif (get_post_meta($post->ID, '_dc_video_youtube', true) != '') { ?>
					<iframe width="600" height="300" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID, '_dc_video_youtube', true);?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>
				<?php } ?>
			<?php } ?>
			</div>
		<?php endwhile; ?>
		<?php // END THE SLIDE LOOP ?>
		</div>
	</div><?php // END #slides ?>
	
	<div id="slide_widget">
		<div id="slide_widget_inner">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Top_Sidebar') ) : endif; ?>
		</div>
	</div>
	<div class="clear"></div>
	</div>
	
	<?php if (count( $sb_count['Home_Page_Banner']) != '0') { ?>
	<div id="home_widgets">
		<div id="home_widget_wrap" class="<?php $sb_count = wp_get_sidebars_widgets(); if (count( $sb_count['Home_Page_Banner']) <= '3') { ?>banner_widget_count<?php count_sidebar_widgets( 'Home_Page_Banner' );?><?php } else { ?>banner_widget_overflow<?php } ?>">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Home_Page_Banner') ) : endif; ?>
			<div class="clear"></div>
		</div>
	</div>
	<?php } ?>
	
	<div class="posts-wrap">
	
	<?php if (of_get_option('video_type') != 'none') { ?>
	<div id="home_video_wrap">
		<div id="home_video">
			<?php if ((of_get_option('vimeo_id') != '') && (of_get_option('video_type') == 'vimeo')) { ?>
			<iframe src="http://player.vimeo.com/video/<?php echo stripslashes(of_get_option('vimeo_id')); ?>?portrait=0" width="380" height="223" frameborder="0"></iframe>
			<?php } if ((of_get_option('youtube_id') != '') && (of_get_option('video_type') == 'youtube')) { ?>
			<iframe width="380" height="223" src="http://www.youtube.com/embed/<?php echo stripslashes(of_get_option('youtube_id')); ?>?wmode=opaque" frameborder="0" allowfullscreen></iframe>
			<?php } ?>
		</div>
		<?php if (of_get_option('video_desc') != '') { ?>
		<div id="home_video_desc">
			<?php if (of_get_option('video_title') != '') { ?>
			<h4><?php echo stripslashes(of_get_option('video_title')); ?></h4>
			<?php } ?>
			<p><?php echo stripslashes(of_get_option('video_desc')); ?></p>
		</div>
		<?php } ?>
		<div class="clear"></div>
	</div>
	<?php } ?>
	
	<?php // START NEWS LOOP ?>
	<?php if (of_get_option('home_posts_selection') == 'posts_all') {
	$home_posts = array(
		'orderby'      => 'desc',
		'post_type'    => 'post',
		'post_status'  => 'publish',
		'posts_per_page' => ''. stripslashes(of_get_option('home_posts_total')) .''
	); } else {
	$home_posts = array(
		'orderby'      => 'desc',
		'post_type'    => 'post',
		'post_status'  => 'publish',
		'posts_per_page' => ''. stripslashes(of_get_option('home_posts_total')) .'',
		'cat' => ''. stripslashes(of_get_option('home_posts_cat')) .''
	); } ?>
	<?php $query_default = new WP_Query($home_posts);
	if ( $query_default->have_posts() ) : ?>
	<div id="home_latest_posts">
		<h4 class="entry-title" id="latest-posts-title"><?php echo stripslashes(of_get_option('home_posts_title')); ?></h4>
		<?php while ( $query_default->have_posts() ) : $query_default->the_post(); global $more; $more = 0; ?>
		<div class="single_latest left">
			<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="single_latest_img_link">
				<?php if (has_post_thumbnail()) { ?>
					<?php the_post_thumbnail( 'single_latest', array('alt' => get_the_title()) ); ?>
				<?php } else { ?>
					<img src="<?php echo get_template_directory_uri(); ?>/images/latest_fallback.png" alt="<?php the_title(); ?>" />
				<?php } ?>
			</a>
			<h5><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h5>
			<div class="meta">
				<?php the_time(get_option( 'date_format' )); ?>	
			</div>
		</div>
	<?php endwhile; ?>
		<div class="clear"></div>
	</div>
	<?php else : // else; no posts

	endif; ?>
	<?php wp_reset_query(); ?>
	<?php // END NEWS LOOP ?>
	
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>