<?php
/*** The template for displaying Search Results pages. ***/

get_header(); ?>

<div id="content-wrapper">
    <div class="container">
    	<div class="sixteen columns">
        	<div id="content-top">
               	<?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
               	<div class="four columns last" id="search-global">
                    <?php get_search_form(); ?>
                </div>
            </div>   
			<div class="medium_separator"></div>
			<h3 class="search-title"><?php printf( __( 'Search Results for: %s', 'Reverence' ), '<mark>' . get_search_query() . '</mark>' ); ?></h3>
			<div class="bottom10"></div>
        </div>
		
        <div class="clear"></div>

 		<div class="sixteen columns">
        	
        	<?php if ( have_posts() ) : ?>
                <?php get_template_part( 'loop', 'search' );?>
            <?php else : ?>
                <div id="post-0" class="post no-results not-found">
                    <h4><?php _e( 'Nothing Found', 'Reverence' ); ?></h4>
                    <div class="entry-content">
                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'Reverence' ); ?></p>
                     </div><!-- .entry-content -->
                </div><!-- #post-0 -->
        	<?php endif; ?>
        </div> 
        <div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>