<?php get_header(); ?>
    <div class="featured">
		<div class="category-list">
        	<?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            <?php 
					$image = "";
					$first_image = $wpdb->get_results(
					
					"SELECT guid FROM $wpdb->posts WHERE post_parent = '$post->ID' "
					."AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1"
					
					);
					
					
					if ($first_image) {
						$image = urldecode($first_image[0]->guid);
					}
                	?>
        	<div class="pic">
            	<a href="<?php the_permalink() ?>" rel="<? bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $image; ?>">
						<img src="<? bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<?php echo $image; ?>&w=70&h=70&zc=1" /></a>
            </div> <!-- .pic -->
            <?php endwhile; ?>
            <div class="navigation">
				<div class="alignleft"><?php next_posts_link('Older') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer') ?></div>
			</div>
            <?php endif;?>
        </div>
        <div class="legend">
        	<h2>Category</h2>

 	  	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  	<?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="pagetitle"><?php single_cat_title(); ?></h3>
 	  	<?php } ?>
		
        <?php
               $catdesc=category_description();
           if(is_string($catdesc)) {
               ?>
           <div class="notes">
               <p>
               <?php
                       echo $catdesc;
               ?></p>
           </div>
       <?php } ?>

        
        </div> <!-- .legend -->
        <div class="ffix"></div>
    </div><!-- #featured -->
<?php get_footer(); ?>