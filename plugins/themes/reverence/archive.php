<?php
/*** The template for displaying Archive pages. **/

get_header(); ?>

<div id="content-wrapper">
    <div class="container">
    	<div class="sixteen columns">
        	<div id="content-top">
            	<?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
               	<div class="four columns last" id="search-global">
                    <?php get_search_form(); ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
		<div class="clear"></div>
    	<div class="sixteen columns">
			<?php
                  if ( have_posts() )
                    the_post();
  	          rewind_posts();
        
             get_template_part( 'loop', 'archive' );
            ?>
    	</div>
       	
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>
