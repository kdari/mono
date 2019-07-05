<?php 
/* Template Name: Portfolio */

get_header(); 

$pageId = $post->ID;

$_SESSION['Reverence_page_id'] = $pageId;
if(!(is_page_template ('homepage-template3.php')))
{
	include('portfolio_header.php');
}

	$renderjs = '';

	$custom =  get_post_custom($post->ID);
	$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
	$portfolio_type = get_post_meta($post->ID, "_portfolio_type", $single = false);
	$paginationEnabled = (isset($portfolio_type) && !(empty ($portfolio_type))) ? $portfolio_type[0] : 0;
	
	if( get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = true) != '' && $paginationEnabled ) 
	{ 
		$items_per_page = get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = false);
	} 
	else 
	{ // else don't paginate
		$items_per_page[0] = 777;
	}
	$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => $items_per_page[0])); 
?>

<?php if ($layout == '3'):?>
	<div class="four columns top20"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Portfolio Sidebar") ) : ?> <?php   endif;?></div>
<?php endif?>
<div class="<?php echo $layout == '1' ? 'sixteen' : 'twelve'?> columns">
	<?php echo getPageContent($pageId); ?>
	
	<!-- Set filtering -->
	<div id="our-portfolio">
		<div id="options" class="clearfix">
			<ul id="filters" class="option-set clearfix" data-option-key="filter">
				<?php if ($paginationEnabled):?>
					<li><a href="<?php echo get_page_link($pageId) ?>" class="selected"><?php _e('Show all', 'Reverence')?></a></li>
					<?php 
						$cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
						$MyWalker = new PortfolioWalker2();
						$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
						$categories = wp_list_categories ($args);
					?>
				<?php else: ?>
					<li><a href="#filter" data-option-value="*" class="selected"><?php _e('Show all', 'Reverence')?></a></li>
					<?php 
						$cats = get_post_meta($post->ID, "_page_portfolio_cat", $single = true);
						$MyWalker = new PortfolioWalker();
						$args = array( 'taxonomy' => 'portfolio_category', 'hide_empty' => '0', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '1');
						$categories = wp_list_categories ($args);
					?>
				<?php endif ?>
					  
			</ul>
			<div class="clear"></div>  
		</div>
	</div>
		  
	<ul class="image-grid threecol portfolio-content <?php if ($layout == '3' || $layout == '2') :?>portfolio-with-sidebar<?php endif?>" id="portfolio-list">
		<?php if( $cats == '' ): ?>
			<li><?php _e('No categories selected. To fix this, please login to your WP Admin area and set
				the categories you want to show by editing this page and setting one or more categories 
				in the multi checkbox field "Portfolio Categories".', 'Reverence')?>
			</li>
		<?php else: ?>		
			<?php 
				// If the user hasn't set a number of items per page, then use JavaScript filtering
				if( $items_per_page == 777 ) : endif; 
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				//  query the posts in selected terms
				$portfolio_posts_to_query = get_objects_in_term( explode( ",", $cats ), 'portfolio_category');
			 ?>
			 <?php if (!empty($portfolio_posts_to_query)):
			
				$wp_query = new WP_Query( array( 'post_type' => 'portfolio', 'orderby' => 'menu_order', 'order' => 'ASC', 'post__in' => $portfolio_posts_to_query, 'paged' => $paged, 'showposts' => $items_per_page[0] ) ); 
				$counter = 1;
				
				$thumbsize = 'portfolio-3-col';
				$videoclass = 'jp-video-filterable';
				$videowrapper = 'filterable-3col-videowrap';
				$audiowrapper = 'filterable-3col-audiowrap';
				$itemsize = 'one-third column';
				$itemwidth = '276';
				$itemheight = '176';
				
				
				if ($wp_query->have_posts()):  ?>
				<?php while ($wp_query->have_posts()) : 							
					$wp_query->the_post();
					$custom = get_post_custom($post->ID);
					if (isset ($custom['_portfolio_item_size']))
					{
						switch ($custom['_portfolio_item_size'][0])
						{
							case 'four columns':
								$thumbsize = 'portfolio-4-col';
								$videoclass = 'jp-video-filterable-4col';
								$videowrapper = 'filterable-4col-videowrap';
								$audiowrapper = 'filterable-4col-audiowrap';
								$itemsize = 'four columns';
								$itemwidth = ' 201';
								$itemheight = '188';
							break;
							
							case 'one-third column':
								$thumbsize = 'portfolio-3-col';
								$videoclass = 'jp-video-filterable';
								$videowrapper = 'filterable-3col-videowrap';
								$audiowrapper = 'filterable-3col-audiowrap';
								$itemsize = 'one-third column';
								$itemwidth = '276';
								$itemheight = '176';
							break;
							
							case 'eight columns':
								$thumbsize = 'portfolio-2-col';
								$videoclass = 'jp-video-filterable-2col';
								$videowrapper = 'filterable-2col-videowrap';
								$audiowrapper = 'filterable-2col-audiowrap';
								$itemsize = 'eight columns';
								$itemwidth = '425';
								$itemheight = '240';
							break;
						}
					}
					
					// Get the portfolio item categories
					$cats = wp_get_object_terms($post->ID, 'portfolio_category');
					if ($cats):
						$cat_slugs = '';
						foreach( $cats as $cat ) {$cat_slugs .= $cat->slug . " ";}
					endif;
					?>
					<?php if (isset($custom['_portfolio_video_m4v']) && $custom['_portfolio_video_m4v'][0]!='' || isset ($custom['_portfolio_video_ogv'][0]) && $custom['_portfolio_video_ogv'][0]!=''):
						$renderjs.='
							$("#jquery_jplayer_'.get_the_ID().'").jPlayer({
								option: {"fullscreen": true},
								ready: function () {
									$(this).jPlayer("setMedia", {';
										if ($custom['_portfolio_video_m4v'][0]!=''):
											$renderjs.= 'm4v: "'.$custom['_portfolio_video_m4v'][0].'",';
										endif;
										if ($custom['_portfolio_video_ogv'][0]!=''):
											$renderjs.= 'ogv: "'.$custom['_portfolio_video_ogv'][0].'",';
										endif;
										if ($custom['_poster_image'][0]!=''):
											$renderjs.= 'poster: "'.$custom['_poster_image'][0].'"';
										else:
											$renderjs.= 'poster: "'.get_template_directory_uri().'/images/video.jpg"';
										endif;
									$renderjs.='    
									});
								},
								play: function() { // To avoid both jPlayers playing together.
									$(this).jPlayer("pauseOthers");
								},
								repeat: function(event) { // Override the default jPlayer repeat event handler
									if(event.jPlayer.options.loop) {
										$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
										$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
											$(this).jPlayer("play");
										});
									} else {
										$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
										$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
											$("#jquery_jplayer_'.get_the_ID().'").jPlayer("play", 0);
										});
									}
								},
								swfPath: "'.get_template_directory_uri().'/js/jplayer",
								supplied: "ogv, m4v",
								size: {width: "'.($itemwidth+4).'px",height: "'.$itemheight.'px",cssClass: "'.$videoclass.'"},
								cssSelectorAncestor: "#jp_container_'.get_the_ID().'"
							});';
						?>
						<li class="element <?php echo $itemsize?> <?php echo $cat_slugs?> singlevideo alpha">                
							<div class="<?php echo $videowrapper ?>">  
								<div id="jp_container_<?php the_ID()?>" class="jp-video  <?php echo $videoclass ?>">
									<div class="jp-type-single">
										<div id="jquery_jplayer_<?php the_ID()?>" class="jp-jplayer"></div>
										<div class="jp-gui">
											<div class="jp-video-play">
												<a href="javascript:;" class="jp-video-play-icon" tabindex="1"><?php _e('play', 'Reverence')?></a>
											</div>
											<div class="jp-interface">
												<div class="jp-progress">
													<div class="jp-seek-bar">
														<div class="jp-play-bar"></div>
													</div>
												</div>
												<div class="jp-current-time"></div>
												<div class="jp-duration"></div>
												<div class="jp-controls-holder">
													<ul class="jp-controls">
														<li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('play', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('pause', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-stop" tabindex="1"><?php _e('stop', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><?php _e('mute', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><?php _e('unmute', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume"><?php _e('max volume', 'Reverence')?></a></li>
													</ul>
													<div class="jp-volume-bar">
														<div class="jp-volume-bar-value"></div>
													</div>
													<ul class="jp-toggles">
														<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen"><?php _e('full screen', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen"><?php _e('restore screen', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat"><?php _e('repeat', 'Reverence')?></a></li>
														<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off"><?php _e('repeat off', 'Reverence')?></a></li>
													</ul>
												</div>
												<div class="jp-title">
													<ul>
														<li><?php the_title()?></li>
													</ul>
												</div>
											</div>
										</div>
										<div class="jp-no-solution">
											<span><?php _e('Update Required', 'Reverence')?></span>
											<?php _e('To play the media you will need to either update your browser to a recent version or update your Flash plugin.', 'Reverence')?>
										</div>
									</div>
								</div>
							</div>
						</li>
					<?php elseif (isset($custom['_portfolio_audio_m4a']) &&  $custom['_portfolio_audio_m4a'][0]!='' || isset($custom['_portfolio_audio_oga']) && $custom['_portfolio_audio_oga'][0]!=''):
						$renderjs.='$("#jquery_jplayer_'.get_the_ID().'").jPlayer({
							ready: function () {
								$(this).jPlayer("setMedia", {';
									if ($custom['_portfolio_audio_m4a'][0]!=''):
										$renderjs.='m4a: "'.$custom['_portfolio_audio_m4a'][0].'",';
									endif;
									if ($custom['_portfolio_audio_oga'][0]!=''):
										$renderjs.='oga: "'.$custom['_portfolio_audio_oga'][0].'",';
									endif;
									if (isset ($custom['_poster_image']) && $custom['_poster_image'][0]!=''):
										$renderjs.='poster: "'.$custom['_poster_image'][0].'"';
									else:
										$renderjs.='poster: "'.get_template_directory_uri().'/images/audio.jpg"';
									endif;
								$renderjs.='});
							},
							play: function() { // To avoid both jPlayers playing together.
								$(this).jPlayer("pauseOthers");
							},
							repeat: function(event) { // Override the default jPlayer repeat event handler
								if(event.jPlayer.options.loop) {
									$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
									$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
										$(this).jPlayer("play");
									});
								} else {
									$(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
									$(this).bind($.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
										$("#jquery_jplayer_'.get_the_ID().'").jPlayer("play", 0);
									});
								}
							},
							swfPath: "'.get_template_directory_uri().'/js/jplayer",
							supplied: "m4a, oga",
							wmode: "window",
							size: {width: "'.$itemwidth.'px",height: "'.$itemheight.'px",cssClass: "'.$videoclass.'"},
							cssSelectorAncestor: "#jp_container_'.get_the_ID().'"});';
						?>
						<li class="element <?php echo $itemsize ?> <?php echo $cat_slugs?> singlesong alpha"> 
							<div class="<?php echo $audiowrapper ?>">    
								<div id="jquery_jplayer_<?php the_ID()?>" class="jp-jplayer"></div>           
								<div id="jp_container_<?php the_ID()?>" class="jp-audio  <?php echo $videoclass ?>">
									<div class="jp-type-single">
										<div class="jp-gui jp-interface">
											<ul class="jp-controls">
												<li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('play', 'Reverence')?></a></li>
												<li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('pause', 'Reverence')?></a></li>
												<li><a href="javascript:;" class="jp-stop" tabindex="1"><?php _e('stop', 'Reverence')?></a></li>
												<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><?php _e('mute', 'Reverence')?></a></li>
												<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><?php _e('unmute', 'Reverence')?></a></li>
												<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume"><?php _e('max volume', 'Reverence')?></a></li>
											</ul>
											<div class="jp-progress">
												<div class="jp-seek-bar">
													<div class="jp-play-bar"></div>
												</div>
											</div>
											<div class="jp-volume-bar">
												<div class="jp-volume-bar-value"></div>
											</div>
											<div class="jp-time-holder">
												<div class="jp-current-time"></div>
												<div class="jp-duration"></div>
						
												<ul class="jp-toggles">
													<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat"><?php _e('repeat', 'Reverence')?></a></li>
													<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off"><?php _e('repeat off', 'Reverence')?></a></li>
												</ul>
											</div>
										</div>
										<div class="jp-title">
											<ul>
												<li><?php the_title()?></li>
											</ul>
										</div>
									   
										<div class="jp-no-solution">
											<span><?php _e('Update Required', 'Reverence')?></span>
											<?php _e('To play the media you will need to either update your browser to a recent version or update your Flash plugin.', 'Reverence')?>
										</div>
									</div>
								</div>
							</div>
						</li>
					<?php else:?>
						<?php $link = ''; $thumbnail = get_the_post_thumbnail($post->ID, $thumbsize);?>
						<li class="element <?php echo $itemsize ?> <?php echo $cat_slugs;?>">
							<?php if (!empty($thumbnail)): ?>
								<?php the_post_thumbnail($thumbsize, array('class' => 'cover')); ?>
							<?php elseif (empty($thumbnail) && !empty ( $custom['_portfolio_video'][0] )):?>
								<img src="<?php echo get_template_directory_uri()?>/images/video_medium.jpg" alt="<?php _e ('No preview video image', 'Reverence') ?>" />
							<?php else :?>
								<img src="<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="<?php _e ('No preview image', 'Reverence') ?>" />
							<?php endif?>
							
							<div class="overlay" style="width:<?php echo $itemwidth?>px; height: <?php echo $itemheight?>px">
								<?php if( !empty ( $custom['_portfolio_video'][0] ) ) : $link = $custom['_portfolio_video'][0]; ?>
									<a href="<?php echo $link ?>" class="video-icon" title="<?php the_title(); ?>" data-rel="prettyPhoto"></a>
								<?php elseif( isset($custom['_portfolio_link'][0]) && $custom['_portfolio_link'][0] != '' ) : $link = $custom['_portfolio_link'][0]; ?>
									<a href="<?php echo $link ?>" class="external-icon" title="<?php the_title(); ?>"></a>
								<?php elseif(  isset( $custom['_portfolio_no_lightbox'][0] )  &&  $custom['_portfolio_no_lightbox'][0] !='' ) : $link = get_permalink(get_the_ID());  ?>
									<a href="<?php echo $link; ?>" class="internal-icon"></a>
								<?php else : 
									$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false); 
									$link = $full_image[0];
									
									$argsThumb = array(
										'order'          => 'ASC',
										'post_type'      => 'attachment',
										'post_parent'    => $post->ID,
										'post_mime_type' => 'image',
										'post_status'    => null,
										'exclude' => get_post_thumbnail_id()
									);
									?>
									<a href="<?php echo $link; ?>" title="<?php the_title(); ?>"  class="gallery-icon" data-rel="prettyPhoto[ppgal<?php echo $post->ID?>]"></a>
									<div class="hover_slideshow">
										
										<?php 
											$attachments = get_posts($argsThumb);
											 
											if ($attachments) {
												foreach ($attachments as $attachment) {
													echo '<a href="'.wp_get_attachment_url($attachment->ID, 'full', false, false).'"  class="gallery-hidden" data-rel="prettyPhoto[ppgal'.$post->ID.']" title="'.get_the_title($post->ID).'"></a>';
												}
											}
										?>
									</div>
								<?php endif; ?>
							</div>
							<a href="<?php echo $link?>" class="item-title"><?php the_title()?></a>	
						</li>
					<?php endif?>
					
				<?php $counter ++; endwhile; ?>
				<?php endif;?>
			<?php endif;?>
		<?php endif?>	
	</ul>	
	<?php if ($paginationEnabled ):?>
		<?php if ( $wp_query->max_num_pages > 1 ): ?>
			<div class="ten columns">
				<?php include(Reverence_PLUGINS . '/wp-pagenavi.php' ); wp_pagenavi(); ?> 
				<div class="clear"></div>
			</div>
		<?php endif?>
	<?php endif?>
	
	<div class="clear"></div>
</div>
<?php if ($layout == '2'):?>
	<div class="four columns top20"> <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Portfolio Sidebar") ) : ?> <?php   endif;?></div>
<?php endif?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		var $container = $('#portfolio-list');
		
		$container.isotope({ 
			animationEngine : "jquery",
			//animationOptions: {easing: 'easeInOutQuad'}, 
			masonry: {columnWidth: 10}
		});
		<?php if (!$paginationEnabled):?>
			var $optionSets = $('#options .option-set'),
			$optionLinks = $optionSets.find('a');
			
			$optionLinks.click(function(){
				var $this = $(this);
				// don't proceed if already selected
				if ( $this.hasClass('selected') ) {
					return false;
				}
				var $optionSet = $this.parents('.option-set');
				$optionSet.find('.selected').removeClass('selected');
				$this.addClass('selected');
				
				// make option object dynamically, i.e. { filter: '.my-filter-class' }
				var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');
				// parse 'false' as false boolean
				value = value === 'false' ? false : value;
				options[ key ] = value;
				if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
					// changes in layout modes need extra logic
					changeLayoutMode( $this, options )
				} 
				else {
					// otherwise, apply new options
					$container.isotope( options );
				}
				
				return false;
			});    
		<?php endif?>
		
		<?php echo $renderjs;?>
	});
	
	
</script>
<?php 
	if(!(is_page_template ('homepage-template3.php')))
	{
		include('portfolio_footer.php'); 
		
	}
	get_footer();
?>
