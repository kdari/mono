<?php
	// load the theme options
	$options = get_option( 'my_corporation_theme_settings' ); 
?>
<?php get_header(' '); ?>
<?php
// get custom post type ==> slides
global $post;
$args = array(
	'post_type' =>'slides',
	'numberposts' => -1,
	'orderby' => 'ASC'
);
$slider_posts = get_posts($args);
?>
<?php if($slider_posts) { ?>
<div id="slider" class="nivoSlider"> 
<?php 
	foreach($slider_posts as $post) : setup_postdata($post);
	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'featured-image');
	// get metabox data
	$slidelink = get_post_meta($post->ID, 'slides_url', TRUE);
?>

      <?php if ( has_post_thumbnail() ) { ?>
		<?php
		// show link with slide if meta exists
		if($slidelink != '') { ?>
     	<a href="<?php echo $slidelink ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbnail[0]; ?>" alt="<?php the_title(); ?>" width="920" title="<?php the_title(); ?>" /></a>
        <?php
         // no meta link defined, show plain img
        } else { ?>
        <img src="<?php echo $thumbnail[0]; ?>" alt="<?php the_title(); ?>" width="920" title="<?php the_title(); ?>" />
        <?php } } ?>
<?php endforeach; ?>
</div>
<!-- END slider -->

<?php } wp_reset_postdata(); // there are no slides ?> 

<?php if ($options['home_text'] !='') { ?>
<div id="home-quote">
	<?php echo stripslashes($options['home_text']);  ?>
</div>
<!-- END homepage-quote -->
<?php } ?>

<?php
	global $post;
	$args = array(
		'post_type' =>'highlights',
		'numberposts' => -1,
		'orderby' => 'ASC'
	);
	$highlights_posts = get_posts($args);
?>
<?php if($highlights_posts) { ?>
<div id="home-highlights" class="clearfix">
	<?php
    $i=0; //start post count at "0"
    foreach($highlights_posts as $post) : setup_postdata($post);
    $i++; //add 1 to the total count
    ?>
    <div class="home-highlight-box  <?php if($i===3){ echo 'remove-margin'; } ?>">
        <h2><span><?php the_title(' '); ?></span></h2>
        <?php if ( has_post_thumbnail() ) {  ?>
        <?php the_post_thumbnail('home-highlights'); ?>
        <?php } ?>
        <?php the_content(' '); ?>
    </div>
    <!-- END home-highlight-box -->
    <?php
    //reset the count to "0" and clear the divs
    if($i===3){ echo '<div class="clear"></div>'; $i=0; } ?>
    <?php endforeach; ?>
</div>
<!--END home-highlights -->
<?php } wp_reset_postdata(); ?>


<?php
	global $post;
	$args = array(
		'post_type' =>'portfolio',
		'numberposts' => 4,
		'orderby' => 'ASC'
	);
	$portfolio_posts = get_posts($args);
?>
<?php if($portfolio_posts) { ?>
<div id="home-portfolio" class="clearfix">
<h2>Latest Work</h2>
	<?php
    $i=0; //start post count at "0"
    foreach($portfolio_posts as $post) : setup_postdata($post);
    $i++; //add 1 to the total count
    ?>
    <div class="portfolio-box  <?php if($i===4){ echo 'remove-margin'; } ?>">
        <?php if ( has_post_thumbnail() ) {  ?>
        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="opacity"><?php the_post_thumbnail('portfolio'); ?></a>
    </div>
    <!-- END home-portfolio-box -->
    <?php } ?>
    <?php
    //reset the count to "0" and clear the divs
    if($i===4){ echo '<div class="clear"></div>'; $i=0; } ?>
    <?php endforeach; ?>
</div>
<!--END home-portfolio -->
<?php } wp_reset_postdata(); ?>

<?php get_footer(' '); ?>