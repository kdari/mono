<?php get_header(); ?>



	<!-- content -->

	<div id="content-outer" class="clear"><div id="content-wrap">

	

		<div id="content">

		

			<div id="left">



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	

			

				<div class="post no-bg">

				

					<h2><?php the_title(); ?></h2>



<?php the_content(); ?>



<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

				</div>



<?php comments_template(); ?>

				

		<?php endwhile; else : ?>



<p>Sorry, no pages matched your criteria.</p>



<?php endif; ?>

				

			</div>

		

<?php get_sidebar(); ?>

<?php get_footer(); ?>