<?php /* Template Name: Blog */

get_header();
$catid = get_query_var('cat');
$cat = &get_category($catid);

$custom =  get_post_custom($post->ID);
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
			<div class="bottom10"></div>			
        </div>
        <div class="clear"></div>
		<?php if ($layout == '3'):?>
			<div class="four columns"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?> <?php   endif;?></div>
		<?php endif?>
 		<div class="<?php echo $layout == '1' ? 'sixteen' : 'twelve'?> columns">
			<?php 
                $temp = $wp_query;
                $wp_query= null;
                $wp_query = new WP_Query();
                $pp = get_option('posts_per_page');
                $wp_query->query('posts_per_page='.$pp.'&paged='.$paged);			
                get_template_part( 'loop', 'index' );
            ?>
    	</div>
       	<?php if ($layout == '2'):?>
			<div class="four columns last left10"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?> <?php   endif;?></div>
		<?php endif?>
        <div class="clear"></div>
	</div>
</div>
<?php get_footer();?>