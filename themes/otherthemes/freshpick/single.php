<?php get_header(); ?>



	<!-- content -->

	<div id="content-outer" class="clear"><div id="content-wrap">

	

		<div id="content">

		

			<div id="left">



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	

			

				<div class="post no-bg">

				

					<h2><?php the_title(); ?></h2>



<p class="post-info">Posted by <?php the_author(); ?> | Filed under <?php the_category(', '); ?></p>



<?php if(get_post_meta($post->ID, "pimage_value", $single = true) != "") { ?><div class="image-section">

<img src="<?php echo get_post_meta($post->ID, "pimage_value", $single = true); ?>" alt="image post"/></div><?php } ?>



<?php the_content(); ?>



<?php the_tags('<p class="tags"><strong>Tagged : </strong>', ', ', '</p>'); ?>



<p class="postmeta">		

<a href="<?php comments_link(); ?>" class="comments">Comments (<?php comments_number('0','1','%'); ?>)</a> | <span class="date"><?php the_time('F jS, Y'); ?></span><?php edit_post_link('Edit', ' | ', ''); ?></p>		

				</div>



<?php comments_template(); ?>

				

		<?php endwhile; else : ?>



<p>Sorry, no posts matched your criteria.</p>



<?php endif; ?>

				

			</div>

		

<?php get_sidebar(); ?>

<?php get_footer(); ?>