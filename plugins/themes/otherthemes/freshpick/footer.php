<?php

global $options;

foreach ($options as $value) {

    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }

}

?>

</div>

	<!-- content end -->	

	</div></div>

		

	<!-- footer starts here -->	

	<div id="footer-outer" class="clear"><div id="footer-wrap">

	

		<div class="col-a">

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Left Footer") ) : ?>

<?php if (function_exists('get_flickrrss')) { ?>

			<h3>Flickr Photostream</h3>					

				

			<p class="thumbs">

			<?php get_flickrrss(); ?> 				

			</p>

<?php } ?>

			

	<?php endif; ?>			

		</div>

		

		<div class="col-a">

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Middle Footer") ) : ?>	

			<h3>Recent Posts</h3>

			

			

				<ul>				

					<?php wp_get_archives('type=postbypost&limit=7'); ?>				

				</ul>



		<?php endif; ?>		

		</div>		

	

		<div class="col-b">

		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Right Footer") ) : ?>

			<h3><?php if ($fp_about_title) { echo $fp_about_title; } else { echo "About"; } ?></h3>			

			

			<p>

			<img src="<?php if ($fp_image_url) { echo $fp_image_url; } else { ?><?php bloginfo('template_url'); ?>/images/gravatar.jpg<?php } ?>" width="40" height="40" alt="about" class="float-left" />



<?php if ($fp_about_message) { echo $fp_about_message; } else { echo "Edit this text in your theme options page. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. 

			Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu 

			posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum 

			odio, ac blandit ante orci ut diam."; } ?></p>

						

	<?php endif; ?>		

		</div>		

	

	<!-- footer ends -->		

	</div></div>

	

	<!-- footer-bottom starts -->		

	<div id="footer-bottom">

		<div class="bottom-left">

			<p>

			&copy; <?php echo date('Y'); ?> <strong><?php bloginfo('name'); ?></strong>&nbsp; &nbsp; &nbsp;

			Design by: <a href="http://www.styleshout.com/">styleshout</a> | Theme by: <a href="http://www.themelab.com">Theme Lab</a>	and <a href="http://www.webhostingreport.com/">Hosting</a>

			</p>

		</div>

	

		<div class="bottom-right">

			<p>		

				<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | 

		   	<a href="http://validator.w3.org/check/referer">XHTML</a>	|			

				<a href="<?php echo get_option('home'); ?>/">Home</a> |

				<a href="http://wordpress.org">WordPress</a> |

				<a href="<?php bloginfo('rss2_url'); ?>">RSS Feed</a>								

			</p>

		</div>

	<!-- footer-bottom ends -->		

	</div>

	

<!-- wrap ends here -->

</div>

<?php wp_footer(); ?>

</body>

</html>