<?php
 
/**
 * Template Name: No Page Title No Sidebar
 *
 * A custom page template without the sidebar or the page title being visible on the page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Kdari_Tiger
 * @since Kdari Tiger 1.0
 */

get_header(); ?>

		<div id="container" class="one-column">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kdaritiger' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'kdaritiger' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>
