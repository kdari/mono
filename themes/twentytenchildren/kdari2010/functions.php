<?php

// Add Header Widgets

add_action( 'init', 'header_widgets_init' );
function header_widgets_init() {
	// First Header Widget Area. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Header Widget Area', 'twentyten' ),
		'id' => 'first-header-widget-area',
		'description' => __( 'The first header widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

	// Second Header Widget Area. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Header Widget Area', 'twentyten' ),
		'id' => 'second-header-widget-area',
		'description' => __( 'The second header widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

}

// We add these widgets to the footer to make sure these widgets are always
// loaded. Sidebar is frequently skipped.
add_action('get_footer', 'insert_header_widget_areas' );
function insert_header_widget_areas(){
	// Insert first header widget area at begining of sidebar output
	if ( is_active_sidebar( 'first-header-widget-area' ) ) : ?>

		<div id="first-header-widget-area" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'first-header-widget-area' ); ?>
			</ul>
		</div><!-- #first-header-widget-area .widget-area -->

<?php endif;

	// Next insert second header widget area
	if ( is_active_sidebar( 'second-header-widget-area' ) ) : ?>

		<div id="second-header-widget-area" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'second-header-widget-area' ); ?>
			</ul>
		</div><!-- #second-header-widget-area .widget-area -->

<?php endif;
}

// this was a fix for the event registration software. Not sure if we still need it in functions. Might have moved it.
// rewrites the EVENT_REGIS_CATEGORY short code
add_shortcode("kw_erc_fix", "kw_erc_fix_shortcode");

// Usage: [kw_erc_fix][EVENT_REGIS_CATEGORY event_category_id="Category Name"][/kw_erc_fix]
function kw_erc_fix_shortcode( $atts, $content = null ) { 
	$content = do_shortcode($content);
	if (strlen($content) > 15) {
		$content = '<h3>Available class times:</h3>' . $content;
	}
	$content = $content . '<p>Subscribe to our <a href="/blog/"><a href="/blog/">blog (see sidebar)</a></a> to be notified when new class times are added, or <a href="/contact-us/">contact us</a> to request a class.</p>';
   return '<div id="class-times">' . $content . '</div>';
}



/* Add Initial Capitals (Init Cap) support.
 * @todo fix namespace
 * @todo try to use [i cap="X"] without closing if possible
 */
add_shortcode("cap", "kw_cap_shortcode");

// Usage: [cap]X[/cap]
function kw_cap_shortcode( $atts, $content = null ) { 
   return '<span class="initcaps initcaps-'.$content.'">' . $content . '</span>';
}


// css switch plugin
// add super light body class switcher to allow alternative css
/**
 * @todo convert to widget. Can still be absolute positioned but works better if it has a home.
 * @todo review name-space
 * @todo add replace 1-7 with iterator up to 20 (w/note to req custom code if more are needed)
 * @todo add option for onHover vs. onClick
 * Usage: Add the following CSS

#css_body_class_switcher {
position: absolute;
top:50px;
right:200px;
}

#switcher01:before {
content: "Normal";
}
#switcher02:before {
content: ".  Easy Read";
}

.cssTheme02 #wrapper {
background: #77f;
}


 */

function insert_css_body_class_switcher_script () {
?>
<script type="text/javascript">
    function changeClass(cssThemeNumber)
    {
	document.getElementsByTagName('body')[0].className = document.getElementsByTagName('body')[0].className.replace(/\bcssTheme[0-9][0-9]\b/,'')
	document.getElementsByTagName('body')[0].className += " cssTheme"+cssThemeNumber;
	}
</script>
<?php
}

function add_css_body_class_switcher () {
	?>
	<div id="css_body_class_switcher"> 
		<a href="#" id="switcher01" onMouseOver="changeClass('01')"></a>
		<a href="#" id="switcher02" onMouseOver="changeClass('02')"></a>
		<a href="#" id="switcher03" onMouseOver="changeClass('03')"></a>
		<a href="#" id="switcher04" onMouseOver="changeClass('04')"></a>
		<a href="#" id="switcher05" onMouseOver="changeClass('05')"></a>
		<a href="#" id="switcher06" onMouseOver="changeClass('06')"></a>
		<a href="#" id="switcher07" onMouseOver="changeClass('07')"></a>
	</div>
	<?php
}

add_action('get_footer', 'add_css_body_class_switcher' );
add_action('get_header', 'insert_css_body_class_switcher_script' ); // is this right action?

function color_scheme_selector() {
?>
<script>
jQuery('a[href^="#color-scheme"]').click(function() {
	jQuery("body").toggleClass(this.hash.substring(1));
	return false;
});
</script>
<?php
}

add_action( 'wp_footer', 'color_scheme_selector' );

?>