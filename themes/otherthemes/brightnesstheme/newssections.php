<?php 

function newssections() 
{
	$cat = wp_dropdown_categories('orderby=id&order=ASC&hide_empty=0&echo=0');
	$cat = str_replace("\n", "", $cat);
	$cat = str_replace("\t", "", $cat);
	$cat = str_replace("<select name='cat' id='cat' class='postform' ><option value=\"", "", $cat);
	$cat = str_replace("</option><option value=\"", "_", $cat);
	$cat = str_replace("\">", "-", $cat);
	$cat = str_replace("</option></select>", "", $cat);
	
	$cat = explode("_", $cat);
	foreach ($cat as $category)
	{
		$category = explode("-", $category);
		$cat_number = $category[0];
		$cat_name = $category[1];
		$ifdisplay = get_option("cat$cat_number");
		$cat_link = get_category_link("$cat_number");
	
		if ($ifdisplay == "yes")
			{ 
				echo '<div class="newssection">';
					echo '<div class="heading">';
						echo '<h3>Latest Posts in <a href="'.$cat_link.'" title="'.$cat_name.'">'.$cat_name.'</a> category</h3>';
						echo '<div class="clear"></div>';
					echo '</div>';
							global $post;
							$myposts = get_posts("numberposts=1&category=$cat_number");
							foreach($myposts as $post)
								{
									$posttitle = get_the_title();
									$posttime = get_the_time('F jS, Y');
									$postauthor = get_the_author();
									$postlink = get_permalink();
									$text = get_the_excerpt();
									$text = substr($text , 0, 150);
									$nothumb = get_bloginfo('template_directory'); 
									$thumb = get_post_meta($post->ID, "Thumbnail", true); 

									echo '<div class="article">';
										echo '<div class="left">';
											echo '<img src="';
												if ($thumb == NULL) { echo ''.$nothumb.'/images/defaultthumb.jpg'; } else { echo $thumb; }
											echo '" alt="'.$posttitle.'" />';
											echo $posttime.'<br />';
											echo $postauthor;
										echo '</div>';
										echo '<div class="right">';
											echo '<h2><a href="'.$postlink.'" title="'.$posttitle.'">'.$posttitle.'</a></h2>';
											echo '<p>'.$text.'[...] <a href="'.$postlink.'" title="Read More">Read More &raquo;</a></p>'; 											
										echo '</div>';
										echo '<div class="clear"></div>';
									echo '</div>'; 
								}
							
							echo '<ul>';
								global $post;
								$myposts = get_posts("numberposts=4&category=$cat_number&offset=1");
								foreach ($myposts as $post)
									{
										$posttitle = get_the_title();
										$posttime = get_the_time('F jS, Y');
										$postauthor = get_the_author();
										$postlink = get_permalink();

										
										echo '<li>';
											echo '<h2>';
												echo '<a href="'.$postlink.'" title="'.$posttitle.'">'.$posttitle.'</a>';
											echo '</h2>';
											echo ''.$posttime.' | '.$postauthor.'';
										echo '</li>';
									
									}
							echo '</ul>';
							echo '<div class="clear"></div>';
				echo '</div>';
			}
	}
}

?>

<?php 
$ens = get_option('ens'); 
if ($ens !== "disable") { ?>

	<?php echo newssections(); ?>
	
<?php } ?>