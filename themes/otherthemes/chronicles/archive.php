<?php get_header(); ?>

<div id="main">
<?php include (TEMPLATEPATH . '/sidebar1.php'); ?>

	<div id="blog">
 	<div class="entry">

<?php if (have_posts()) : ?>

  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h2 class="search">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category &raquo;</h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h2 class="search">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="search">Archive for <?php the_time('F jS, Y'); ?>:</h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="search">Archive for <?php the_time('F, Y'); ?>&raquo;</h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="search">Archive for <?php the_time('Y'); ?>:</h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="search">Author Archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="search">Blog Archives</h2>
 	  <?php } ?>
      
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<div class="date">
<?php the_time('M d Y'); ?>
</div><!--end of date -->

<div class="post_title">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<div class="posted">Posted by <?php the_author_posts_link(); ?> </div><!--end of posted -->
</div><!--end of post_title -->

<br clear="all" />

<div class="tags"><?php the_tags('Tags: ', ', ', '<br />'); ?></div><!--end of tags -->

<?php the_content('Read more &raquo;'); ?>

<div class="meta">
Filed under : <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
</div><!--end of meta -->

</div><!--end of post -->

	<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else : ?>
	<?php endif; ?>

</div><!--end of entry -->
</div><!--end of blog -->

<?php include (TEMPLATEPATH . '/sidebar2.php'); ?>

<br clear="all" />
</div><!--end of main -->

<?php get_footer(); ?>