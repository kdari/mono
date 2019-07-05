<?php get_header(); ?>
<div class="posts-wrap the_blog search_results">
	<h3 id="search" class="page-title"><?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $count = $allsearch->post_count; echo $count . ' '; wp_reset_query(); ?><?php _e("Search results for", "designcrumbs"); ?> <strong><?php the_search_query() ?></strong></h3>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php get_template_part( 'loop', 'post' ); ?>
        
	<?php endwhile; ?>
		
	<div class="navigation navigation-index">
		<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'designcrumbs')) ?></div>
		<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'designcrumbs')) ?></div>
		<div class="clear"></div>
	</div>

	<?php else : ?>
	<div class="post">
		<div class="entry-content">
			<?php _e("We're sorry, but", "designcrumbs"); ?> <strong><?php the_search_query() ?></strong> <?php _e("returns no results. Please try your search again, or navigate around the site with the links on top.", "designcrumbs"); ?>
		</div>
	</div>
	<?php endif; ?>
</div><!-- end .posts-wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>