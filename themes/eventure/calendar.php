<?php
//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
	$theme_options = get_option('option_tree');
	$eventCat = get_option_tree('event_cat',$theme_options);
} 
?>

<!--FILTER-->
<div id="filter" class="blackBar">
<ul>
	<li><a class="active" href="#"><?php echo get_cat_name($eventCat); ?></a></li>
	<?php
	$cats = wp_list_categories('child_of='.$eventCat.'&title_li=&echo=0');
	if (!strpos($cats,'No categories') ){
		echo $cats;
	}
	?>
</ul>
</div>

<!--UL DATE LIST-->
<ul id="dateList">
<?php
$prev_month = '';
$prev_year = '';
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('order=ASC&cat='.$eventCat.'&showposts=200'.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post(); 
if(get_the_time('M') != $prev_month || get_the_time('Y') != $prev_year){ 
?>

	<li class="box monthYear" id="<?php echo get_the_time('M'); echo get_the_time('y'); ?>">
		<a class="dateLink" href="<?php echo home_url(); ?>/<?php echo get_the_time('Y/m'); ?>">
			<span><?php echo get_the_time('M'); ?></span><br />
			<?php echo get_the_time('Y'); ?>
		</a>
	</li>

<?php }	?>
	
	<li class="box postEvent<?php foreach((get_the_category()) as $category) {echo ' '.$category->category_nicename.'';}?>">
		<a  href="<?php the_permalink(); ?>">
			<span class="theDay"><?php echo get_the_time('d'); ?></span><br />
			<p class="theTitle">
				<span><?php echo get_the_time('D @ g:i a'); ?></span><br />
				<?php echo the_title(); ?>
			</p>
		</a>                    
	</li>
	
<?php
$prev_month = get_the_time('M');
$prev_year = get_the_time('Y');	
endwhile; 
$wp_query = null; 
$wp_query = $temp;?>

<li class="box" id="theEnd"><?php _e("The End.");?></li>
</ul><!--END DATE LIST-->