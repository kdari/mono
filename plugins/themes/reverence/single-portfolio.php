<?php
/*** Portfolio Single Posts template. ***/

get_header(); 
$pageId = isset ($_SESSION['Reverence_page_id']) ? $_SESSION['Reverence_page_id'] : get_page_ID_by_page_template('portfolio-template.php');
$custom =  get_post_custom($pageId);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';

?>

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
       
        <?php if ($layout == '3'):?>
			<div class="four columns"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Portfolio Sidebar") ) : ?> <?php   endif;?></div>
		<?php endif?>
 		<div class="<?php echo $layout == '1' ? 'sixteen' : 'twelve'?> columns"> 
        	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        		<?php the_content(); ?>
            <?php endwhile; ?>	          
    	</div>
        <?php if ($layout == '2'):?>
			<div class="four columns last"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Portfolio Sidebar") ) : ?> <?php   endif;?></div>
		<?php endif?> 
        <div class="clear"></div>
        
		
	</div>
</div>
<?php get_footer(); ?>