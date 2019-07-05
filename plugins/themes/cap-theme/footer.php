<?php
/**
 * Template for or Carole Ann Penney child theme
 *
 * Contains the closing of the id=main div and all content after
 *
 */
?>

<?php // clear after all floats so background image stretches to bottom ?>
<br style="clear: both;" />

</div><!-- #main -->

<?php if ( is_front_page() ) : ?>
	<section class="home-footer">
	<?php
		$cap_posts = new WP_Query( 'posts_per_page=1' );
		$cap_posts->the_post();
		$cap_post = $cap_posts->post->ID;
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

				<?php twentyeleven_posted_on(); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->

		<aside id="mc_embed_signup">
			<?php cap_do_mailchimp() ?>
			<span style="font-size: 2.5em; font-weight: bold; display: block;">INSPIRATION</span>
			<span style="font-size: 2.1em;">IN YOUR INBOX!</span>
			<p style="font-size: 1.1em; font-style: italic;line-height: 1.6em;margin-top: .4em;">Monthly tools and tricks from me&nbsp;to&nbsp;you.</p>
		</aside>

		<?php cap_do_testimonial() ?>
		<div class="clear"></div>

		<aside class="cap-social cap-social-footer">
			<a href="http://eepurl.com/MdPm1" target="_blank" class="social-one"></a>
			<a href="http://caroleannctd.tumblr.com/" target="_blank" class="social-two"></a>
			<a href="http://www.instagram.com/caroleannctd" target="_blank" class="social-three"></a>
			<a href="https://www.facebook.com/caroleannctd" target="_blank" class="social-four"></a>
			<a href="http://www.pinterest.com/caroleannctd" target="_blank" class="social-five"></a>
			<a href="http://twitter.com/caroleannctd" target="_blank" class="social-six"></a>
			<a href="http://lnkd.in/3J2vV8" target="_blank" class="social-seven"></a>
		</aside>
	</section>
<?php endif; ?>

</div><!-- #page -->

<footer id="colophon" role="contentinfo">
	<div id="site-generator">
		&copy; CAROLE ANN PENNEY 2014 &nbsp; | &nbsp; DESIGN:&nbsp;<a href="http://kristindivona.com/">KRISTIN&nbsp;DIVONA</a> &nbsp; | &nbsp; WEB&nbsp;DEVELOPMENT:&nbsp;<a href="http://luke.gedeon.name">LUKE&nbsp;GEDEON</a> &nbsp; | &nbsp; HEADSHOTS:&nbsp;<a href="http://www.mattferraraphotography.com​">MATT&nbsp;FERRARA&nbsp;PHOTOGRAPHY</a> &nbsp; | &nbsp; POWERED&nbsp;BY&nbsp;<a href="http://wordpress.org">WORDPRESS</a>
	</div>
</footer><!-- #colophon -->

<script type="application/javascript">
	function cap_hamburger(){
		this.className=("active"==this.className.substr(0, 6))?"":"active";
	}
	document.querySelector('#hamburger').addEventListener('click', cap_hamburger )
</script>

<?php wp_footer(); ?>

</body>
</html>