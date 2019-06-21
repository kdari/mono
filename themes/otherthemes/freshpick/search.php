<?php get_header(); ?>



	<!-- content -->

	<div id="content-outer" class="clear"><div id="content-wrap">

	

		<div id="content">

		

			<div id="left">



		<?php if (have_posts()) : ?>



<h2>Search Results</h2>





		<div class="page-navigation clear">

			<div class="float-left"><?php next_posts_link('&laquo; Older Entries') ?></div>

			<div class="float-right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>

		</div>



<ul class="archive">



		<?php while (have_posts()) : the_post(); ?>



<li>

<div class="post-title"><strong><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong></div>

<div class="post-details">Posted on <?php the_time('F jS, Y'); ?> | Filed under <?php the_category(', '); ?></div>

</li>

		

		<?php endwhile; ?>

</ul>



		<div class="page-navigation clear">

			<div class="float-left"><?php next_posts_link('&laquo; Older Entries') ?></div>

			<div class="float-right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>

		</div>



<?php else : ?>



<h2 class="center">No posts found. Try a different search?</h2>



<?php endif; ?>

				

			</div>

		

<?php get_sidebar(); ?>

<?php get_footer(); ?>