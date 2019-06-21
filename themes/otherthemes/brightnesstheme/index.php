<?php get_header(); ?>
<?php 
$efeatured = get_option("efeatured");
if ($efeatured !== "disable") { ?>
<div class="featured">
	<div class="wrap">
		<div class="leftalign">
		<?php 
		$featuredcat = get_option('featuredcat');
		$my_query = new WP_Query("category_name=$featuredcat&showposts=1");
		while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate = $post->ID; ?>
			<span class="smalltitle">Featured Article:</span>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<img src="<?php $nothumb = get_bloginfo('template_directory'); $thumb = get_post_meta($post->ID, "Big Thumbnail", true); if ($thumb == NULL) { echo ''.$nothumb.'/images/defaultthumbfeatured.jpg'; } else { echo $thumb; } ?>" alt="Post Title" />
			<div class="postcontent">
				<?php 
				$text = get_the_excerpt();
				if(strlen($text ) > 250) {
				$text = substr($text , 0, 250);
				}
				echo '<p>'.$text.'...</p>'; 
				?>
				<a href="<?php the_permalink(); ?>" class="more-link">Read the rest</a>
			</div>
			<div style="clear:both;"></div>
		<?php endwhile; ?>
		</div>
		<div class="rightalign">
		<?php 
		$eadv = get_option("eadv"); 
		if ($eadv !== "disable") { ?>
				<span class="smalltitle">Advertising:</span>
				<div class="advertisment">
				<?php
				$big_ad = get_option("big_ad");
				$big_ad = stripslashes($big_ad);

				if($big_ad == "") {
					echo "Go to Wordpress Dashboard &raquo; Design Tab &raquo; Brightness Settings and add advertising codes!";
				}
				else {
					echo $big_ad;
				}
				?>
				</div>
		<?php } ?>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
<?php } ?>
<div style="display: block; height: 21px; width: 100%;"></div>
<div class="wrap">
	<div class="maincontent">
		<div class="newssection">
			<div class="heading">
				<h3>Latest 10 Articles:</h3>
				<a href="<?php bloginfo('rss_url'); ?>" title="RSS Feeds" class="rss">Rss Feeds</a>
				<div class="clear"></div>
			</div>
			<?php $odd_or_even = 'odd'; ?>
			<?php if (have_posts()) : while (have_posts()) : the_post();
			if( $post->ID == $do_not_duplicate ) continue; update_post_caches($posts); ?>
				<div class="article <?php echo $odd_or_even; ?>">
				<?php $odd_or_even = ('odd'==$odd_or_even) ? 'even' : 'odd'; ?>				
					<div class="left">
						<img src="<?php $nothumb = get_bloginfo('template_directory'); $thumb = get_post_meta($post->ID, "Thumbnail", true); if ($thumb == NULL) { echo ''.$nothumb.'/images/defaultthumb.jpg'; } else { echo $thumb; } ?>" alt="<?php the_title(); ?>" />
						<?php the_time('F jS, Y') ?><br />
						<?php the_author(); ?>
					</div>
					<div class="right">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<p><?php 
						$text = get_the_excerpt();
						if(strlen($text ) > 150) {
						$text = substr($text , 0, 150);
						}
						echo ''.$text.'[...]'; 
						?>
						<a href="<?php the_permalink(); ?>" title="Go to <?php the_title(); ?>">Read the rest &raquo;</a></p>
					</div>
					<div class="clear"></div>
				</div>
			<?php endwhile; ?>			
			<?php endif; ?>
			<div  class="clear"></div>
		</div>
		<?php include (TEMPLATEPATH . '/newssections.php'); ?>
	</div>
	<?php get_sidebar(); ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>

