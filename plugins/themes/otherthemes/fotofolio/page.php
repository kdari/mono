<?php get_header(); ?>
    <div class="featured">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	
        <div class="legend page">
            <h3><? the_title(); ?></h3>
            <div class="notes">
            	<?php the_content(); ?>
            </div>
        </div> <!-- .legend -->
        <?php endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
        <div class="ffix"></div>
    </div><!-- #featured -->
<?php get_footer(); ?>