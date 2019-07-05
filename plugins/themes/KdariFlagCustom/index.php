<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */

get_header(); ?>

<section id="page"> 
 
		<section id="carousel">
<style>#slideshow-wrapper {float:left;}</style>
        <?php echo do_shortcode("[slideshow custom=1]"); ?>
        </section>
 
		<section id="the-church"> 
			<h2>Church Information</h2> 
			<ul> 
				<li id="sunday-services"> 
					<h4><?php echo reverse_escape(get_option('cap_worship_times_title')); ?></h4> 
					<p><?php echo reverse_escape(get_option('cap_worship_times')); ?></p> 
				</li> 
				<li id="address"> 
					<h4><?php echo reverse_escape(get_option('cap_address_title')); ?></h4> 
					<p><?php echo reverse_escape(get_option('cap_address')); ?></p> 
				</li> 
				<li id="contact-info"> 
					<h4>Contact Information</h4> 
					<p>Tel: <?php echo reverse_escape(get_option('cap_phone_number')); ?></p> 
					<p>Email: <?php echo reverse_escape(get_option('cap_email')); ?></p> 
				</li> 
				<li id="new-here"> 
					<p><a href="<?php echo reverse_escape(get_option('cap_new_here_link')); ?>">I'm New Here &rarr;</a></p> 
				</li> 
			</ul> 
		</section> 
 
		<section id="call-to-action"> 
			<h2 class="hide">Call To Action</h2> 
			<ul> 
				<li>
					<?php /* Widgetized sidebar */
   					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('f_p_box1') ) : ?><?php endif; ?>
				</li>
						
				<section id="socialize"> 
			<div class="lines-top"><div class="lines-bottom"> 
				<h2 class="hide">Socialize</h2> 
				<ul> 
					<li class="tweets"><a href="<?php echo get_option('cap_twitter_username'); ?>" target="_blank">Tweets About Our<br /> Upcoming Events</a></li> 
					<li class="likes"><a href="<?php echo get_option('cap_facebook_url'); ?>" target="_blank">Like us on<br /> Facebook</a></li> 
					<li class="subscribe"><a href="<?php echo get_option('cap_feedburner'); ?>" target="_blank">Subscribe To Our<br /> Email Updates</a></li> 
				</ul> 
			</div></div> 
		</section> 
				
				<li>
					<?php /* Widgetized sidebar */
  					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('f_p_box2') ) : ?><?php endif; ?>
				</li>
				<li>
			</ul> 
		</section> 
 
 
 
<?php
//sermons
$args = array( 'post_type' => 'cpt_sermons',
'showposts' => 1);
$the__events_query = new WP_Query($args);	
global $post;
$sermonposts = get_posts($args);
foreach($sermonposts as $post) : 
 
?>
		<script type="text/javascript">
        <!--
        function home_sermon_popup() {
        window.open( "<?php echo get_template_directory_uri();?>/includes/sermon-popup/?mp3=<?php echo get_post_meta($post->ID, 'sermonmp3', true) ?>&ogg=<?php echo get_post_meta($post->ID, 'sermonogg', true)?>&title=<?php echo get_the_title(); ?>", "myWindow", 
        "status = 1, height = 116, width = 422, resizable = 0" )
        }
        //-->
        </script>                  
		<section id="latest-download"> 
			<div class="lines-top"><div class="lines-bottom">			
				<ul class="container"> 
					<li class="title"> 
						<h2><a href="<?php echo get_template_directory_uri();?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>&fname=<?php echo get_the_title(); ?>">Latest Sermon Download</a></h2> 
					</li> 
					<li> 
						<ul class="details"> 
							<li>Sermon: <?php the_title(); ?></li> 
							<li>Pastor: <?php echo get_post_meta($post->ID, 'sermonauthor', true); ?></li> 
							<li>Date: <?php the_time('F j, Y'); ?></li> 
						</ul> 
					</li> 
					<li> 
						<ul class="options"> 
							<li class="listen"><a onClick="home_sermon_popup()" href="#">Listen</a></li> 
							<li class="download"><a href="<?php echo get_template_directory_uri();?>/includes/mp3.php?file=<?php echo get_post_meta($post->ID, 'sermonmp3', true); ?>&fname=<?php echo get_the_title(); ?>">Download</a></li> 
						</ul> 
					</li> 
				</ul> 
			</div></div> 
		</section> 
 <?php endforeach; ?>
		
 
		<section id="we-believe"> 
			<h2><?php echo reverse_escape(get_option('cap_whatwebelieve_title')); ?></h2> 
			<p><?php echo reverse_escape(get_option('cap_whatwebelieve')); ?></p>
		</section> 
 
		<section id="news-announcements"> 
			<h2>News &amp; Announcements</h2> 
			<ol> 
            
<?php 
$args = array( 'post_type' => 'cpt_news',
'showposts' => 5);
$the__news_query = new WP_Query($args);	
global $post;
$newsposts = get_posts($args);
foreach($newsposts as $post) : 
?>                     
				<li> 
					<span class="date"> 
						<span class="day"><?php the_time('j'); ?><span>th</span></span> 
						<span class="month"><?php the_time('F'); ?></span> 
					</span> 
					<span class="title"> 
						<span class="hide"> - </span> 
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> 
					</span> 
				</li> 
<?php endforeach; ?>
				
			</ol> 
		</section> 
 
	</section> 
 

<?php get_footer(); ?>