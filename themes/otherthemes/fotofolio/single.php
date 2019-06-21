<?php get_header(); 

global $options;
foreach ($options as $value) {
	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}

?>
    <div class="featured single">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	<div class="photo shadow-left">
        	<div class="shadow-right">
            	<?php

				$image = "";
					$first_image = $wpdb->get_results(
					
					"SELECT ID,guid FROM $wpdb->posts WHERE post_parent = '$post->ID' "
					."AND post_type = 'attachment' ORDER BY `post_date` ASC LIMIT 0,1"
					
					);
					
					
					if ($first_image) {
						$image = $first_image[0]->guid;
						$imageID = $first_image[0]->ID;
					}
					$imagepos = urldecode($image);
					
                	?>
                    
                    <?php
					list($width, $height, $type, $attr) = getimagesize("$imagepos");
					if ($width > $height) { ?>
						<img src="<? bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<? echo $image ?>&w=480&h=275&zc=1" alt="<? the_title(); ?>" />
                        <?php
					} else { ?>
						<img src="<? bloginfo('template_directory'); ?>/scripts/timthumb.php?src=<? echo $image ?>&w=380&h=663&zc=1" alt="<? the_title(); ?>" />
						<?php
						$horizontal = 'style="width:400px"';
                    }
					?>
                    


            </div>
        </div>
        <div class="legend">
        	<h2><?php the_category(', '); ?></h2>
            <h3><? the_title(); ?></h3>
            <div class="author"><em>by</em> <strong><?php the_author(); ?></strong></div>
            <div class="notes">
            	<p>
            	<?php the_content(); ?></p>
                <p>
            	<?php
				if ($ftfl_exif == "false") {
    			echo "";
				} else { ?>
                
                <h5>Data</h5>
    			<?php $exif = mooz_get_meta($imageID);
				echo "ISO: ";
				echo $exif['iso']; 
				echo "<br />Camera: ";
				echo $exif['cam']; ?>

    			<?php } ?>
                </p>
            </div>
        </div> <!-- .legend -->
		<div class="navigation" <?php echo $horizontal; ?>">
			<div class="alignleft"><?php previous_post_link('%link', 'Previous', TRUE); ?> </div>
			<div class="alignright"><?php next_post_link('%link', 'Next', TRUE); ?> </div>
		</div>
        <?php endwhile; else: ?>
			<h2>Sorry, no posts matched your criteria.</h2>
		<?php endif; ?>
        <div class="ffix"></div>
    </div><!-- #featured -->
<?php get_footer(); ?>
