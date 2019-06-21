<?php 
get_header(); 

//OptionTree Stuff
if ( function_exists( 'get_option_tree') ) {
	$theme_options = get_option('option_tree');
	$eventCat = get_option_tree('event_cat',$theme_options);
} 

if (have_posts()) : while (have_posts()) : the_post();
$data = get_post_meta( $post->ID, 'key', true );

if ($data[ 'google_map' ]) { 
?>
<div class="mapEmbed" id="bannerMap">
<iframe width="900" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $data[ 'google_map' ]; ?>&amp;output=embed&amp;iwloc=near"></iframe>
</div><!--end mapEmbed-->
<?php } ?>

<div id="postDetails">
		
		<?php 
		$args = array('post_type' => 'attachment','post_mime_type' => 'image' ,'post_status' => null, 'post_parent' => $post->ID);
		$attachments = get_posts($args);
		?>
		
		<ul id="detailsTabs">
			<li class="activeTab">Details</li>
			<?php if ($attachments) { ?><li>Gallery</li><?php } ?>
			<li>Tags</li>
			<li>More</li>
		</ul>
		
		<ul id="metaStuff">
			<!--FIRST-->
			<li class="currentInfo">
			
				<h2 id="postTitle"><?php the_title(); ?><?php edit_post_link(' <small>&#9997;</small>','',' '); ?></h2>
				<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>	
			
				<?php  $postDate = get_the_date('m/d/y g:ia'); if ( strtotime($postDate) > time()) {?>
				<div id="countDown">
					<script type="text/javascript">
					CountActive = true;
					TargetDate = "<?php the_time('m/d/Y g:i a'); ?>";
					DisplayFormat = "<span>%%D%%</span> d &nbsp;&nbsp;&nbsp; <span>%%H%%</span> h &nbsp;&nbsp;&nbsp; <span>%%M%%</span> m &nbsp;&nbsp;&nbsp; <span>%%S%%</span> s";
					FinishMessage = "Countdown Complete";
					</script>
					<script src="<?php echo get_template_directory_uri(); ?>/scripts/countdown.js" type="text/javascript"></script>
				</div><!--end countDown-->
				<?php  } ?>
								
				<div class="smallMeta">
					<img src="<?php echo get_template_directory_uri();?>/images/calendar.gif" alt="" />&nbsp;&nbsp;&nbsp;<?php the_time('l, F jS, Y'); ?><br />
					<img src="<?php echo get_template_directory_uri();?>/images/clock.gif" alt="" />&nbsp;&nbsp;&nbsp;<?php the_time('g:i a'); ?><br />
					<img src="<?php echo get_template_directory_uri();?>/images/folder.gif" alt="" />&nbsp;&nbsp;&nbsp;<?php the_category(', '); ?><br />
					<img src="<?php echo get_template_directory_uri();?>/images/person.gif" alt="" />&nbsp;&nbsp;&nbsp;<?php the_author(); ?><br />
					<img src="<?php echo get_template_directory_uri();?>/images/comment_left.gif" alt="" />&nbsp;&nbsp;&nbsp;<?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?><br />
				</div>
			</li>

			
			<!--SECOND-->
			<?php if ($attachments) { ?>
			<li>
				<ul class="galleryBox">
       				<?php attachment_toolbox('small'); ?>
       			</ul>
			</li>
			<?php } ?>
			
			<!--THIRD-->
			<li id="theTags">
				<?php the_tags('','');?>
				<div class="clear"></div>
			</li>
			
			<li><?php get_sidebar();?></li>

		</ul>
	</div>

	<div  <?php post_class(); ?>>
		
		<div class="entry">
		
			<div id="postNav">
				<div id="nextpage" class="pagenav"><?php next_post_link('%link','&rarr;',true) ?></div>
				<div id="backpage" class="pagenav"><?php previous_post_link('%link','&larr;',true) ?></div>
			</div><!--end postNav-->
			
			<h2 id="postTitle"><?php the_title(); ?><?php edit_post_link(' <small>&#9997;</small>','',' '); ?></h2>
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>	
			
			<div class="socialButton">	
				<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
			</div>
			<div class="socialButton">	
				<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
				<g:plusone size="medium" count="false"></g:plusone>
			</div>	
			<div class="socialButton" id="facebookLike">
				<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php the_permalink() ?>" send="false" layout="button_count" width="90" height="21" show_faces="true" action="like" colorscheme="light" font=""></fb:like>
			</div>	
			<div class="clear"></div>
			
			<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
			
			 <?php wp_link_pages(); ?>
			
			<div class="clear"></div>	
			
        </div><!--end entry-->
        
        <br />
                    
        <div id="commentsection">
			<?php comments_template(); ?>
        </div>
        
			
	</div><!--end post-->
	
<?php 
endwhile; endif;
get_footer(); 
?>