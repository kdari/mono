<?php
/**
 * Template Name: Short Sidebar Template
 *
 * Description: A Page Template that adds a short sidebar to pages.
 *
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

	<div id="secondary" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-s' ) ?>
	</div><!-- #secondary .widget-area -->

<?php get_footer(); ?>