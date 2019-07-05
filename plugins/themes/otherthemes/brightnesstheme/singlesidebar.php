<? 
/* Template Name: Single Sidebar (Sidebar shown in Single Posts)  */
?>
	<div class="singlesidebar">
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
		<div class="item newssection">
			<div class="heading">
				<h3>Latest Posts</h3>
				<div class="clear"></div>
			</div>
			<?php $my_query = new WP_Query('showposts=1');
			while ($my_query->have_posts()) : $my_query->the_post();
			$do_not_duplicate = $post->ID; ?>
			<div class="article">
				<div class="left">
					<img src="<?php $nothumb = get_bloginfo('template_directory'); $thumb = get_post_meta($post->ID, "Thumbnail", true); if ($thumb == NULL) { echo ''.$nothumb.'/images/defaultthumb.jpg'; } else { echo $thumb; } ?>" alt="<?php the_title(); ?>" />
					<?php the_time('F jS, Y') ?><br />
					<?php the_author(); ?>
				</div>
				<div class="right">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php 
					$text = get_the_excerpt();
					if(strlen($text ) > 150) {
					$text = substr($text , 0, 150);
					}
					echo '<p>'.$text.'[...]'; 
					?>
					<a href="<?php the_permalink(); ?>" title="Go to <?php the_title(); ?>">Read the rest &raquo;</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<?php endwhile; ?>
			<ul><?php $my_query = new WP_Query('showposts=5&offset=1');
			while ($my_query->have_posts()) : $my_query->the_post();
			$do_not_duplicate = $post->ID; ?>
				<li><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_time('F jS, Y'); ?> | <?php the_author(); ?></li>
			<?php endwhile; ?></ul>
			<div class="clear"></div>
		</div>
	</div>
