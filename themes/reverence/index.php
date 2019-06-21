<?php /** The default template for pages. **/ ?>

<?php get_header(); ?>

<div id="content-wrapper">
    <div class="container">
    	<div class="twelve columns">
			<?php  get_template_part( 'loop', 'index' ); ?>
    	</div>
        <aside class="four columns">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Global Sidebar") ) : ?> <?php   endif;?>
        </aside> 
        <div class="clear"></div>
	</div>
</div>


<?php get_footer(); ?>
