<?php
/**
 * @package WordPress
 * @subpackage P2
 */

function KdariP2_show_comments() {
	global $withcomments;
	$withcomments = 1;
}
add_action( 'get_template_part_loop', 'KdariP2_show_comments' );
?>