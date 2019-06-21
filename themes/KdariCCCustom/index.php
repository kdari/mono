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
        <?php echo do_shortcode("[slideshow_deploy id='1615']"); ?>

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
				<li>
					<?php /* Widgetized sidebar */
  					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('f_p_box2') ) : ?><?php endif; ?>
				</li>
				<li>
					<?php /* Widgetized sidebar */
				    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('f_p_box3') ) : ?><?php endif; ?>
				</li>
				<li>
					<?php /* Widgetized sidebar */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('f_p_box4') ) : ?><?php endif; ?>
				</li>
			</ul>
		</section>


	

		<section id="we-believe">
			<h2><?php echo reverse_escape(get_option('cap_whatwebelieve_title')); ?></h2>
			<p><?php echo reverse_escape(get_option('cap_whatwebelieve')); ?></p>
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
		
<section id="news-announcements">
			<h2>News &amp; Announcements</h2>
			<ol>
				<?php get_sidebar(); ?>
			</ol>
		</section>
		
	
		
	</section>


<?php get_footer(); ?>