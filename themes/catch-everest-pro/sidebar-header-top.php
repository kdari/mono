<?php
/**
 * The Header Top widget areas.
 *
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 1.2
 */
?>
<?php 
/** 
 * catcheverest_before_header_top hook
 */
do_action( 'catcheverest_before_header_top' ); ?> 
<?php 
if ( is_active_sidebar( 'sidebar-header-top' ) ) {	?>
    <div id="header-top" class="header-sidebar widget-area">
    	<div class="container">
    		<?php dynamic_sidebar( 'sidebar-header-top' ); ?>
        </div>
    </div><!-- #header-right .widget-area -->
<?php 
}
/** 
 * catcheverest_after_header_top hook
 */
do_action( 'catcheverest_after_header_top' ); ?> 