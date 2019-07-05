<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 1.0
 */
?>

<?php 
/** 
 * catcheverest_above_secondary hook
 */
do_action( 'catcheverest_before_secondary' ); ?>

<?php 
	global $post;
	
	// Post /Page /General Layout
	if ( $post) {
		if ( is_attachment() ) { 
			$parent = $post->post_parent;
			$layout = get_post_meta( $parent, 'catcheverest-sidebarlayout', true );
			$sidebaroptions = get_post_meta( $parent, 'catcheverest-sidebar-options', true );
			
		} else {
			$layout = get_post_meta( $post->ID, 'catcheverest-sidebarlayout', true ); 
			$sidebaroptions = get_post_meta( $post->ID, 'catcheverest-sidebar-options', true ); 
		}
	}
	else {
		$sidebaroptions = '';
	}
			
	if( empty( $layout ) || ( !is_page() && !is_single() ) )
		$layout='default';
		
	// Getting data from Theme Options
	global $catcheverest_options_settings;
	$options = $catcheverest_options_settings;
	$themeoption_layout = $options['sidebar_layout'];
	
	if ( ( $layout == 'left-sidebar' || $layout == 'right-sidebar' || ( $layout=='default' && $themeoption_layout == 'left-sidebar') || ( $layout=='default' && $themeoption_layout == 'right-sidebar') ) ) { ?>

		<div id="secondary" class="widget-area" role="complementary">
			<?php 
			/** 
			 * catcheverest_before_widget_start hook
			 */
			do_action( 'catcheverest_before_widget_start' );
			
			if ( is_active_sidebar( 'sidebar-optional-homepage' ) && ( is_home() || is_front_page() ) ) {
            	dynamic_sidebar( 'sidebar-optional-homepage' ); 
       		}
			elseif ( is_archive() && is_active_sidebar( 'sidebar-optional-archive' ) ) {
            	dynamic_sidebar( 'sidebar-optional-archive' ); 
        	}					
			elseif ( is_active_sidebar( 'sidebar-optional-three' ) && $sidebaroptions == 'optional-sidebar-three' ) {
            	dynamic_sidebar( 'sidebar-optional-three' ); 
       		}
			elseif ( is_active_sidebar( 'sidebar-optional-two' ) && $sidebaroptions == 'optional-sidebar-two' ) {
            	dynamic_sidebar( 'sidebar-optional-two' ); 
       		}
			elseif ( is_active_sidebar( 'sidebar-optional-one' ) && $sidebaroptions == 'optional-sidebar-one' ) {
            	dynamic_sidebar( 'sidebar-optional-one' ); 
       		}
			elseif ( is_page_template( 'page-blog.php' ) && is_active_sidebar( 'sidebar-optional-archive' ) ) {
            	dynamic_sidebar( 'sidebar-optional-archive' ); 
        	}			
			elseif ( is_page() && is_active_sidebar( 'sidebar-optional-page' ) ) {
				dynamic_sidebar( 'sidebar-optional-page' ); 
			}	
			elseif ( is_single() && is_active_sidebar( 'sidebar-optional-post' ) ) {
				dynamic_sidebar( 'post-sidebar' ); 
			}	
			elseif ( is_active_sidebar( 'sidebar-1' ) ) {
            	dynamic_sidebar( 'sidebar-1' ); 
       		}	
			else { ?>
				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>
		
				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'catcheverest' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>
			
			<?php 
			} // end sidebar widget area ?>
			
			<?php 
			/** 
			 * catcheverest_after_widget_ends hook
			 */
			do_action( 'catcheverest_after_widget_ends' ); ?>    
		</div><!-- #secondary .widget-area -->
        
		<?php
	}
	
/** 
 * catcheverest_after_secondary hook
 */
do_action( 'catcheverest_after_secondary' );