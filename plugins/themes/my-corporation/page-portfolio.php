<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(' '); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<h1 class="page-title"><?php the_title(); ?></h1>			
<?php the_content(); ?>
<?php endwhile; ?>
<?php endif; ?>

<div id="portfolio-wrap" class="clearfix">
<?php
	global $post;
	$args = array(
		'post_type' =>'portfolio',
		'numberposts' => -1,
		'orderby' => 'ASC'
	);
	$portfolio_posts = get_posts($args);
?>
<?php if($portfolio_posts) { ?>
<?php
    $i=0; //start post count at "0"
    foreach($portfolio_posts as $post) : setup_postdata($post);
    $i++; //add 1 to the total count
    ?>
    <div class="portfolio-box  <?php if($i===4){ echo 'remove-margin'; } ?>">
        <?php if ( has_post_thumbnail() ) {  ?>
        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="opacity"><?php the_post_thumbnail('portfolio'); ?></a>
        <?php } ?>
    </div>
    <!-- END home-portfolio-box -->
    <?php
    //reset the count to "0" and clear the divs
    if($i===4){ echo '<div class="clear"></div>'; $i=0; } ?>
    <?php endforeach; ?>
<?php } wp_reset_postdata(); ?>            

</div>
<!-- END post-content -->       
<?php get_footer(' '); ?>