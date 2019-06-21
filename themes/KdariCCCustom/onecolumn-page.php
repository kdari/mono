<?php
/**
 * Template Name: Full Width
 *
 * A custom page template.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Moses Theme by Church Themer
 * @since Moses Theme by Church Themer 3.0
 */


get_header(); ?>

<section id="page"> 
<div id="full-page">
		<article> 
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<header> 
				<h2><?php the_title(); ?></h2> 
			</header> 
			<section> 
				<?php the_content(); ?>
			</section> 
			<?php edit_post_link( __( 'Edit', 'ezekiel' ), '', '' ); ?>

			
            
            <?php endwhile; ?>
		</article> 
</div> 
</section> 

<?php comments_template( '', true ); ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>