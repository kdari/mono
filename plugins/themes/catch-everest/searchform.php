<?php
/**
 * The template for displaying search forms in Catch Everest
 *
 * @package Catch Everest
 * @since Catch Everest 1.0
 */

// get the data value from theme options
global $catcheverest_options_settings;
$options = $catcheverest_options_settings;

$catcheverest_search_text = $options['search_display_text'];
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="screen-reader-text"><?php esc_html_e( 'Search', 'catch-everest' ); ?></label>
		<input type="text" class="field" name="s" value="<?php the_search_query(); ?>" id="s" placeholder="<?php echo $catcheverest_search_text; ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'catch-everest' ); ?>" />
	</form>
