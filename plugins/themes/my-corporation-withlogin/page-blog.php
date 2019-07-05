<?php
/*
Template Name: Blog
*/
?>
<?php get_header(' '); ?>
<div id="post-content">

<?php query_posts( array( 'paged'=>$paged ) ); ?>
<?php if (have_posts()) : ?>              
<?php get_template_part( 'post' , 'entry') ?>                	
<?php endif; ?>   
            
<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
</div>
<!-- END post-content -->

<?php get_sidebar(' '); ?>           
<?php get_footer(' '); ?>