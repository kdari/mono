<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

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
        </div>
        <div class="clear"></div>

 		<div class="sixteen columns bottom20">
        	<div id="not-found-content">
				<h1><?php _e('404 Error - Page not found', 'Reverence')?></h1>
                <p>
                	<?php _e(' Oooooops... it looks like the page you were looking for does not exist anymore or is temporarily 
                    unavailable. You might want to search our website or browse our website.', 'Reverence')?>                   
                </p>
                <a href="javascript: history.go(-1)" class="button"><?php _e('Return to previous page', 'Reverence')?></a>
            </div>
		</div>
		<div class="sixteen columns">
			<?php echo do_shortcode('[sitemap /]')?>
		</div>
    </div>
</div>


<?php get_footer(); ?>