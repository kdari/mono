<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Ezekiel
 * @since Ezekiel 3.0
 */
?>

<div class="foot-wrap"><div class="foot-texture">
		<footer class="global">
			<?php wp_nav_menu( array('container' => 'false', 'theme_location' => 'primary' ) ); ?>
			<p>&copy; 2011 <a href="http://www.churchthemer.com/">Church Themer, Inc.</a> A subsidiary of <a href="http://mintthemes.com/">Mint Idea LLC.</a></p>
		</footer>
	</div></div>

	<!-- JavaScript / jQuery -->

	<script type="text/javascript" src="_js/jquery.js"></script>
	<script type="text/javascript" src="_js/carousel.js"></script>
	<script type="text/javascript" src="_js/theme.js"></script>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
