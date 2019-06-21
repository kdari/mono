<?php
/**
 * The main template file.
 *
 * @package Codegrade_Custom_Theme
 */

get_header();

if ( have_posts() ) :

	while ( have_posts() ) : the_post();

		get_template_part( 'parts/content', get_post_format() );

	endwhile;

else :

	get_template_part( 'parts/content', 'none' );

endif;

get_footer();
