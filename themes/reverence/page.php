<?php /* Template Name: Regular page */ ?>

<?php get_header();
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
        </div>
        <div class="clear"></div>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php if ($layout == '3'):?>
				<div class="four columns"><?php generated_dynamic_sidebar() ?></div>
			<?php endif?>
			<div class="<?php echo $layout == '1' ? 'sixteen' : 'twelve'?> columns">
				<?php the_content(); ?>
			</div>
			<?php if ($layout == '2'):?>
				<div class="four columns"><?php generated_dynamic_sidebar() ?></div>
			<?php endif?>
		<?php endwhile; ?>	
		<div class="clearnospacing"></div>
    </div>
</div>
    
<?php get_footer(); ?>