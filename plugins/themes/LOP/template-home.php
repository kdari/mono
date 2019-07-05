<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>
<?php $cat_tab_1 = $data['lop_tab_1_title'];  ?>
<?php $cat_tab_2 = $data['lop_tab_2_title'];  ?>
<?php $cat_tab_3 = $data['lop_tab_3_title'];  ?>
<?php $post_number = get_option('lp_post_num');  ?>

		<div id="content">
			<div id="content-left">
				<!-- slide-container -->
                <div class="slider-wrapper lop-theme">
                    <div id="slider" class="nivoSlider">
						<?php
							global $data;
						    if ($data['lop_slider_img']) {
								$images = $data['lop_slider_img']; 
								foreach ($images as $image) {
									$imgtitle = $image['title'];
									$imgurl = $image['url'];
									$imglink = $image['link'];
									$imgdesc = $image['description'];
								
								if ($imglink) {	
									echo '<a href="'.$imglink.'">';	
									echo '<img src="'.$imgurl.'" data-thumb="'.$imgurl.'" alt="'.$imgtitle.'" title="'.$imgdesc.'" />';
									echo '</a>';
								} else {
									echo '<img src="'.$imgurl.'" data-thumb="'.$imgurl.'" alt="'.$imgtitle.'" title="'.$imgdesc.'" />';
								}
							};
						} ?>                    
                    </div>
                </div>
<div class="widget-post">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home-main') ) : ?>
    <?php endif; ?>
</div>


				<?php if ( $data['lop_latest_posts'] == 0 ) { ?>
					<ul class="tabs">
                    	<?php if ($data['lop_tab_1'] == 1 )  { ?>
							<li><a href="#tab1"><?php echo stripslashes ($cat_tab_1) ?></a></li>
                        <?php } ?>
                    	<?php if ($data['lop_tab_2'] == 1 )  { ?>
							<li><a href="#tab2"><?php echo stripslashes ($cat_tab_2) ?></a></li>
                        <?php } ?>
                    	<?php if ($data['lop_tab_3'] == 1 )  { ?>
							<li><a href="#tab3"><?php echo stripslashes ($cat_tab_3) ?></a></li>
						<?php } ?>
					</ul>
					<!-- tab-container -->
					<div class="tab_container">
						<!-- tab-content begin -->
                        <?php if ($data['lop_tab_1'] == 1 )  { ?>
	                        <div id="tab1" class="tab_content">
                                <ul class="tab-post">
									<?php 
										if ($data['lop_tab_1_id']) { 
										    $the_query = new WP_Query( $data['lop_tab_1_id'] ); 
										} else { 
											$the_query = new WP_Query( '&posts_per_page=1' ); 
										} 
										while ( $the_query->have_posts() ) : $the_query->the_post();
										$tab_content = $data['lop_tab_1_style'];
										include(TEMPLATEPATH.'/library/tab-content.php'); 
										endwhile; wp_reset_postdata();												
									?>
                                </ul>
	                        </div>
                        <?php } if ($data['lop_tab_2'] == 1 ) { ?>
						<div id="tab2" class="tab_content">
							<?php 
								if ($data['lop_tab_2_id']) { 
								    $the_query = new WP_Query( $data['lop_tab_2_id'] ); 
								} else { 
									$the_query = new WP_Query( '&posts_per_page=1' ); 
								} 
								while ( $the_query->have_posts() ) : $the_query->the_post();
																		$tab_content = $data['lop_tab_2_style'];

								include(TEMPLATEPATH.'/library/tab-content.php'); 
								endwhile; wp_reset_postdata();												
							?>
						</div>
                        <?php } if ($data['lop_tab_3'] == 1 ) { ?>
						<div id="tab3" class="tab_content">
							<?php 
								if ($data['lop_tab_3_id']) { 
								    $the_query = new WP_Query( $data['lop_tab_3_id'] ); 
								} else { 
									$the_query = new WP_Query( '&posts_per_page=1' ); 
								} 
								while ( $the_query->have_posts() ) : $the_query->the_post();
																		$tab_content = $data['lop_tab_3_style'];

								include(TEMPLATEPATH.'/library/tab-content.php'); 
								endwhile; wp_reset_postdata();												
							?>
						</div>
                        <?php } ?>
						<!-- tab-content end -->
					</div>
				<?php } else { ?>
					<div id="main-content">
						<?php query_posts("showposts=$post_number"); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="post">
							<h2 class="line"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<?php the_post_thumbnail(); ?>
							<?php the_excerpt(); ?>
							<p class="meta"><?php the_time('F j, Y'); ?> in <?php the_category(', '); ?> by <?php the_author_posts_link() ?></p>
							<p class="meta"><?php comments_popup_link('No comments yet', '1 comment', '% comments', '', 'Comments are disabled for this post'); ?></p>
						</div>
						<!--/box-->
						<?php endwhile; else: ?>
						<h2>404 - Not Found</h2>
						<p>The page you are looking for is not here.</p>
						<?php endif; ?>
					</div>
				<?php } ?>
            </div>
			<div id="content-right"><?php get_sidebar('home'); ?></div>
        </div>
        <!--content end-->
    </div>
    <!--main end-->
</div>
<!--wrapper end-->
<div class="clear"></div>
<?php get_footer(); ?>