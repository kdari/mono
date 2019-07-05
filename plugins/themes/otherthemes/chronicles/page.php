<?php get_header(); ?>

<div id="main">
<?php include (TEMPLATEPATH . '/sidebar1.php'); ?>

	<div id="blog">
 	<div class="entry">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">

<div class="post_title">
<h2><?php the_title(); ?></h2>
</div><!--end of post_title -->

<br clear="all" />

<div class="tags"><?php the_tags('Tags: ', ', ', '<br />'); ?></div><!--end of tags -->

<?php the_content('Read more &raquo;'); ?>

<?php edit_post_link('Edit', '', ''); ?>

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