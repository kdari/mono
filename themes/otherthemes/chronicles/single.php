<?php get_header(); ?>

<div id="main">
<?php include (TEMPLATEPATH . '/sidebar1.php'); ?>

	<div id="blog">
 	<div class="entry">

<?php if (have_posts()) : ?>
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
<?php comments_template(); ?>
</div><!--end of post -->

	<?php endwhile; ?>
	<?php else : ?>
	<?php endif; ?>

</div><!--end of entry -->
</div><!--end of blog -->

<?php include (TEMPLATEPATH . '/sidebar2.php'); ?>

<br clear="all" />
</div><!--end of main -->

<?php get_footer(); ?>