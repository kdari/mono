<?php /*** The loop that displays posts.***/ ?>

<?php 

$al_options = get_option('al_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';

?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'Reverence' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'Reverence' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>


<?php while ( have_posts() ) : the_post(); ?>
   <article id="post-<?php the_ID();?>" <?php post_class('post-block'); ?>>
        <!--Image-->
        <h3 class="uppercase"><?php the_title(); ?></h3>
        
        <?php if($al_options['al_blog_show_date']): ?>
        	<time datetime="<?php echo get_the_time('Y-m-d'); ?>"  class="post-date uppercase"><?php echo get_the_time('M d'); ?></time>
        <?php endif?>
        <?php $custom =  get_post_custom_values("_post_video") ?>
        
		<div class="five columns alpha">
            <div class="featured-image">
            	<?php  
				$thumbnail = get_the_post_thumbnail($post->ID, 'blog-list');
				if(!empty($thumbnail) && !$custom):?>
                    <a href="<?php the_permalink()?>"><?php the_post_thumbnail('blog-list'); ?></a>
            	<?php elseif ($custom): ?>
                	<?php echo do_shortcode ('[vimeo id="'.$custom[0].'" width="250" height="192" class="" /]');?>
               	<?php else: ?>
                	<a href="<?php the_permalink()?>">
                		<img src = "<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="No image" style="width:260px; height:200px" />
                    </a>
				<?php endif ?>
			</div>
			<!-- Show post author if set from admin panel -->
			<?php if($al_options['al_blog_show_author']): ?>
				<p class="post-author"><a href="<?php echo get_the_author_link(); ?>"><?php echo get_the_author(); ?></a></p>
			<?php endif?>
			
			<!-- Show comments if set from admin panel -->
			<?php if( 'open' == $post->comment_status && $al_options['al_blog_show_comments']) : ?>        
				<p class="post-comment"><?php comments_popup_link( __( '0 Comments', 'Reverence' ), __( '1 Comment', 'Reverence' ), __( '% Comments', 'Reverence' )); ?></p>
			<?php endif?>
			<div class="clearsmall"></div>
		
        </div>
		
        <div class="<?php echo $layout == '1' ? 'eleven' : 'seven'?> columns last">
			<!-- Show excerpt -->
            <p class="bottom20"><?php echo  do_shortcode(get_the_excerpt()); ?></p>
       		
           	<!-- Show permalink -->
            <p>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %1$s', 'Reverence' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
					<?php echo isset($al_options['al_blogreadmore']) ? $al_options['al_blogreadmore'] : _e ('Read More', 'Reverence') ?>
				</a>
            </p>
			       
        </div>
        <div class="clearsmall"></div>                
   </article>
   <div class="bottom20"></div> 
<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>

<div class="navigation">
	<?php if ( $wp_query->max_num_pages > 1 ) :
       include(Reverence_PLUGINS . '/wp-pagenavi.php' );
       if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
    ?>
    <?php endif; ?>
    <div class="clear" style="height:40px"></div>
</div>
