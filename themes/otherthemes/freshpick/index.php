<?php get_header(); ?>



<?php if (is_home() && !is_paged()) {

$sticky=get_option('sticky_posts');

$the_query = new WP_Query('showposts=1&p=' . $sticky[0]);

if ($the_query->have_posts()) :

  while ($the_query->have_posts()) : $the_query->the_post();

  $do_not_duplicate = $post->ID;

?>

	<!-- featured starts -->	

	<div id="featured" class="clear">				

				

		

			<div class="image-block">

  <img src="<?php if(get_post_meta($post->ID, "image_value", $single = true) != "") { echo get_post_meta($post->ID, "image_value", $single = true); } else { ?><?php bloginfo('template_url'); ?>/images/img-featured.jpg<?php } ?>" alt="featured"/>            

         </div>			

			

			<div class="text-block">

			

				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

			

				<p class="post-info">Posted by <?php the_author(); ?> | Filed under <?php the_category(', ') ?></p>



<?php the_excerpt(); ?>				

				

<p><a href="<?php the_permalink(); ?>" class="more-link">Read More</a></p>



</div>



	

	<!-- featured ends -->	

	</div>



<?php endwhile; endif; } ?>

	

	<!-- content -->

	<div id="content-outer" class="clear"><div id="content-wrap">

	

		<div id="content">

		

			<div id="left">



<?php



if (have_posts()) : while (have_posts()) : the_post(); 

if  ( $post->ID == $do_not_duplicate ) { continue; update_post_caches($posts); }



?>	

			

				<div class="entry">

				

					<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>



<?php the_content('Read the rest of this entry &raquo;'); ?>

				

				</div>

				

		<?php endwhile; ?>



<div class="page-navigation clear">

			<div class="float-left"><?php next_posts_link('&laquo; Older Entries') ?></div>

			<div class="float-right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>

		</div>



	<?php else : ?>



<h2 class="center">Not Found</h2>

		<p class="center">Sorry, but you are looking for something that isn't here.</p>





<?php endif; ?>

				

			</div>

		

<?php get_sidebar(); ?>

<?php get_footer(); ?>