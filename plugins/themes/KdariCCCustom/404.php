<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */

get_header(); ?>


<section id="page">

				<h1><?php _e( 'Not Found', 'ezekiel' ); ?></h1>
				<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'ezekiel' ); ?></p>
				<?php get_search_form(); ?>

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

</section>


<?php get_footer(); ?>