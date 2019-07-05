<?php
//7uJdzoyEf33KZEryVp8y0BfHEPpT69S7FzN2fHahoDRGqkX  get_header(); ?>
<div class="wrap">
	<?php if (have_posts()) : ?>
			<div class="singlepost">
				<div class="heading">
				 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				 	  <?php /* If this is a category archive */ if (is_category()) { ?>
						<h3 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h3>
				 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
						<h3 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h3>
				 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
						<h3 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h3>
				 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<h3 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h3>
				 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<h3 class="pagetitle">Archive for <?php the_time('Y'); ?></h3>
					  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
						<h3 class="pagetitle">Author Archive</h3>
				 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<h3 class="pagetitle">Blog Archives</h3>
				 	  <?php } ?>
					  <div class="clear"></div>
				</div>
				<?php while (have_posts()) : the_post(); ?> 
					<div class="post" id="post-<?php the_ID(); ?>">
						<div class="posthead">
							<h2><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<span>By <?php the_author(); ?> + <?php the_time('F jS, Y') ?></span>
							<p></p>
						</div>
						<div class="postcontent">
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php endwhile; ?>
				<div class="navigation">
					<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
					<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					<div class="clear"></div>
				</div>
			</div>
			
	<?php endif; ?>
	<?php include (TEMPLATEPATH . '/singlesidebar.php'); ?>
	<div class="clear"></div>
</div>
<?php get_footer(); ?>
