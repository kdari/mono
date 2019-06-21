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

<!--[if IE]>
<link rel="stylesheet" media="screen" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" />
<![endif]-->

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
					<a href="<?php echo get_option('cap_home_image1_link'); ?>">
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image1')); }else{ echo get_option('cap_home_image1');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image1_text'); ?>" class="rounded-img" />
					</a>
				</li>
				<li>
					<a href="<?php echo get_option('cap_home_image2_link'); ?>">
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image2')); }else{ echo get_option('cap_home_image2');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image2_text'); ?>" class="rounded-img" />
					</a>
				</li>
				<li>
					<a href="<?php echo get_option('cap_home_image3_link'); ?>">
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image3')); }else{ echo get_option('cap_home_image3');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image3_text'); ?>" class="rounded-img" />
					</a>
				</li>
				<li>
					<a href="<?php echo get_option('cap_home_image4_link'); ?>">
					<img src="<?php bloginfo( 'template_directory' ); ?>/thumb.php?src=<?php if (is_multisite()){get_current_site(1)->path; echo str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),get_option('cap_home_image4')); }else{ echo get_option('cap_home_image4');}?>&h=169&w=220&zc=1" alt="<?php echo get_option('cap_home_image4_text'); ?>" class="rounded-img" />
					</a>
				</li>
			</ul>
		</section>




		<section id="socialize">
			<div class="lines-top"><div class="lines-bottom">
				<h2 class="hide">Socialize</h2>
				<ul>
					<li class="tweets"><a href="<?php echo get_option('cap_twitter_username'); ?>" target="_blank">Tweets About Our<br /> Upcoming Events</a></li>
					<li class="likes"><a href="<?php echo get_option('cap_facebook_url'); ?>" target="_blank">Like us on<br /> Facebook</a></li>
					<li class="subscribe"><a href="<?php echo get_option('cap_feedburner'); ?>" target="_blank">Listen to Sermons<br /> Online</a></li>
				</ul>
			</div></div>
		</section>


		<section id="we-believe">
			<h2><?php echo reverse_escape(get_option('cap_whatwebelieve_title')); ?></h2>
			<p><?php echo reverse_escape(get_option('cap_whatwebelieve')); ?></p>
		</section>


		<section class="sermon-box">
			<img style="visibility:hidden;width:0px;height:0px;" border=0 width=0 height=0 src="http://c.gigcount.com/wildfire/IMP/CXNID=2000002.11NXC/bT*xJmx*PTEzMTQwNjU*NDgxNjAmcHQ9MTMxNDA2NTg2NDU5NiZwPTEzNjgyMSZkPSZnPTEmb2Y9MA==.gif" /><embed src="http://sermonplayer.com/swf/free_ads_player.swf" quality="high" width="320" height="397" name="player" align="middle" allowScriptAccess="always" wmode="transparent" allowfullscreen="true" type="application/x-shockwave-flash" flashvars="clientid=27978&d=http://sermonplayer.com/" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
		</section>



		<section id="news-announcements">
			<h2>News &amp; Announcements</h2>
			<ol>

				<?php get_sidebar(); ?>

			</ol>
		</section>

	</section>


<?php get_footer(); ?>