<?php get_header(); ?>
<div class="posts-wrap the_blog">
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	
		<?php get_template_part( 'loop', 'post' ); ?>
        
	<?php endwhile; ?>
	<div class="navigation navigation-index">
		<div class="nav-prev"><?php next_posts_link( __('&laquo; Older Entries', 'designcrumbs')) ?></div>
		<div class="nav-next"><?php previous_posts_link( __('Newer Entries &raquo;', 'designcrumbs')) ?></div>
		<div class="clear"></div>
	</div>

	<?php else : ?>
	<h2><?php _e("We can't find what you're looking for.", "designcrumbs"); ?></h2>
	<p><?php _e("Please try one of the links on top.", "designcrumbs"); ?></p>
        
	<?php endif; ?>
</div><!-- end .posts-wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
