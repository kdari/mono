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
        
			<?php
            // array of 3 images for the homepage
            $faderimages = array(
                'first' => array(
                    'image' => get_option('cap_slider_image1'),
                    'url' => get_option('cap_slider_link1'),
                ),
                'second' => array(
                    'image' => get_option('cap_slider_image2'),
                    'url' => get_option('cap_slider_link2'),
                ),
                'third' => array(
                    'image' => get_option('cap_slider_image3'),
                    'url' => get_option('cap_slider_link3'),
                ),
				 'fourth' => array(
                    'image' => get_option('cap_slider_image4'),
                    'url' => get_option('cap_slider_link4'),
                ),
				  'fifth' => array(
                    'image' => get_option('cap_slider_image5'),
                    'url' => get_option('cap_slider_link5'),
                ),
				   'sixth' => array(
                    'image' => get_option('cap_slider_image6'),
                    'url' => get_option('cap_slider_link6'),
                ),
            );
            ?>
                          
			<section id="slides"> 
				<?php 
                // loop through all the images, only rendering if there's an image
                foreach($faderimages as $num => $fader) {
                    if(!strstr($fader['image'], ' URL')) {
                ?>  
				<span class="round-slide" style="background: url(<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$fader['image']); }else{ echo $fader['image'];}?>&h=291&w=701&zc=1) no-repeat top left; width: 700px;"> 
                <a href="<?php echo $fader['url']; ?>"> 
                    <img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$fader['image']); }else{ echo $fader['image'];}?>&h=291&w=701&zc=1" alt="<?php echo $num; ?>" /> 
                   </a> 
				</span>		
             	
             <?php
				// else show a default image
				}else{ ?>
					
				<?php
				  // end image check for faders
				}
				// end loop through faders
				} ?>	
																		
			</section> 
			<ul id="thumbnails"> 
            <?php 
                // loop through all the images, only rendering if there's an image
                foreach($faderimages as $num => $fader) {
					if(!strstr($fader['image'], ' URL')) {
                ?>  
				<li> 
					<a href="#" class="rounded-img" style="background: url(<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$fader['image']); }else{ echo $fader['image'];}?>&h=82&w=102&zc=1) no-repeat top left;"> 
						<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$fader['image']); }else{ echo $fader['image'];}?>&h=82&w=102&zc=1" alt="<?php echo $num; ?>" /> 
					</a> 
				</li> 
                <?php } }?>
													
			</ul> 
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
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image1')); }else{ echo get_option('cap_home_image1');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image1_text'); ?>" class="rounded-img" /> 
					<aside> 
						<a href="<?php echo get_option('cap_home_image1_link'); ?>"><?php echo reverse_escape(get_option('cap_home_image1_text')); ?></a> 
					</aside> 
				</li> 
				<li> 
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image2')); }else{ echo get_option('cap_home_image2');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image2_text'); ?>" class="rounded-img" /> 
					<aside> 
						<a href="<?php echo get_option('cap_home_image2_link'); ?>"><?php echo reverse_escape(get_option('cap_home_image2_text')); ?></a> 
					</aside> 
				</li> 
				<li> 
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image3')); }else{ echo get_option('cap_home_image3');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image3_text'); ?>" class="rounded-img" /> 
					<aside> 
						<a href="<?php echo get_option('cap_home_image3_link'); ?>"><?php echo reverse_escape(get_option('cap_home_image3_text')); ?></a> 
					</aside> 
				</li> 
				<li> 
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image4')); }else{ echo get_option('cap_home_image4');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image4_text'); ?>" class="rounded-img" /> 
					<aside> 
						<a href="<?php echo get_option('cap_home_image4_link'); ?>"><?php echo reverse_escape(get_option('cap_home_image4_text')); ?></a> 
					</aside> 
				</li> 
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