<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>
<?php $al_options = get_option('al_general_settings'); ?>	
<?php 
	
	$id = get_page_ID_by_page_template('blog-template.php'); 
	$custom =  get_post_custom($id);
	$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
	$name = get_page_name_by_ID($id); 
?>
<script type="text/javascript">
	jQuery(document).ready(function(){ 
		jQuery(".sf-menu a:contains('<?php echo $name?>')").parent().addClass('current-menu-item');
	});
</script>
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
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                 <article class="post-block inner-block" id="post-<?php the_ID();?>">
                    <!--Image-->
                    <h3><?php the_title(); ?></h3>
					
					<?php if($al_options['al_blog_show_date']): ?>
                        <time datetime="<?php echo get_the_time('Y-m-d'); ?>"  class="post-date"><?php echo get_the_time('d M, Y'); ?></time>
                    <?php endif?>
                     
                    <div class="inner-post-desc bottom20">
                        <?php the_content(); ?>
                    </div>
                    
					<?php if($al_options['al_blog_show_author']): ?>
						<p class="post-author"><a href="<?php echo get_the_author_link(); ?>"><?php echo get_the_author(); ?></a></p>
					<?php endif?>
					
					<!-- Show comments if set from admin panel -->
					<?php if( 'open' == $post->comment_status && $al_options['al_blog_show_comments']) : ?>        
						<p class="post-comment"><?php comments_popup_link( __( '0 Comments', 'Reverence' ), __( '1 Comment', 'Reverence' ), __( '% Comments', 'Reverence' )); ?></p>
					<?php endif?>
					<div class="clearsmall"></div>
                	                
               	</article>
                <div class="bottom20"></div>  
				 <?php if($al_options['al_blog_show_rp']): //echo $post->ID?>
					<?php echo do_shortcode('[related_posts postId="'.$post->ID.'" /]'); ?>     
                <?php endif?>
                <div class="clear"></div>
				<div class="inner-comments">
					<?php if( 'open' == $post->comment_status):?> 
						<div class="big_separator top10 bottom10"></div>
						<?php comments_template( '', true );?>
						<?php $test = false; if ($test) {comment_form(); wp_link_pages( $args );} ?>
					<?php endif ?>	
				</div>
            <?php endwhile; ?>
    	</div>
       	<?php if ($layout == '2'):?>
			<div class="four columns last"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?> <?php   endif;?></div>
		<?php endif?> 
    	<div class="clear"></div>
	</div>
</div>	

<?php get_footer(); ?>