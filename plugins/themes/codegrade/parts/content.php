<?php
/**
 * Template part for displaying posts.
 *
 * @package Codegrade_Custom_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		the_content();
	?>

</article><!-- #post-## -->
