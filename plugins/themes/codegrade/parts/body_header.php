<?php
/**
 * The default header section.
 *
 * Opens the body tag then outputs the visible header. Called after head.php via get_template_part().
 *
 * @package Codegrade_Custom_Theme
 */

?>
<body <?php body_class(); ?>>

<?php do_action( 'top_of_body' ); ?>