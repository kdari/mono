<?php
// Reset the content width for the child theme. Our functions.php runs first, and parent checks if this isset.
	$content_width = 584;

// change twentyeleven's default header size
	function __cap_return_386() { return 386; }
	function __cap_return_1220() { return 1220; }
	add_filter( 'twentyeleven_header_image_width', '__cap_return_1220' );
	add_filter( 'twentyeleven_header_image_height', '__cap_return_386' );


// over-ride the posted on section
function twentyeleven_posted_on() {
	printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		'<span>' . esc_html( get_the_date( 'M') ) . '</span><span>' . esc_html( get_the_date( 'j') ) . '</span><span>' . esc_html( get_the_date( 'Y') ) . '</span>'
	);
}

function cap_do_mailchimp() {
	?>
<!-- Begin MailChimp Signup Form -->
	<form action="http://caroleannpenney.us3.list-manage.com/subscribe/post?u=c852ffc92e59caffdce98be43&amp;id=5414229a04" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

		<div class="mc-field-group">
			<input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="first name">
		</div>
		<div class="mc-field-group">
			<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="email">
		</div>
		<div id="mce-responses" class="clear">
			<div class="response" id="mce-error-response" style="display:none"></div>
			<div class="response" id="mce-success-response" style="display:none"></div>
		</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
		<div style="position: absolute; left: -5000px;"><input type="text" name="b_c852ffc92e59caffdce98be43_5414229a04" value=""></div>
		<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
	</form>
<!--End mc_embed_signup-->
	<?php
}

function cap_add_typekit_header() {
	$url = get_option( 'siteurl' );
	if ( false !== strpos( $url, 'kdari.com' ) || false !== strpos( $url, '.dev' ) ) {
		// development account
		$src = "//use.typekit.net/iuj8kod.js";
	} else {
		// production account
		$src = "//use.typekit.net/cih8ljz.js";
	}

	?>
<script type="text/javascript" src="<?php echo $src ?>"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){console.log('typekit failed')}</script>
	<?php
}
add_filter( 'wp_head', 'cap_add_typekit_header' );

function cap_remove_sidebars() {
	// Unregister some of the parent theme's sidebars
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
	unregister_sidebar( 'sidebar-4' );
	unregister_sidebar( 'sidebar-5' );
}
add_action( 'widgets_init', 'cap_remove_sidebars', 11 );

function cap_create_testimonial_post_type() {
	register_post_type( 'cap_testimonial',
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonial' )
			),
			'public' => true,
			'has_archive' => true,
		)
	);
}
add_action( 'init', 'cap_create_testimonial_post_type' );

function cap_do_testimonial() {
	$args = array( 'post_type' => 'cap_testimonial', 'posts_per_page' => 1, 'orderby' => 'rand' );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<aside class="testimonial">
			<h3>Kind Words</h3>
			<blockquote><?php the_content(); ?> <span class="name">&mdash;&nbsp;<?php the_title(); ?></span></blockquote>
		</aside>
		<?php
	endwhile;
}

function twentyeleven_continue_reading_link() {
	return '<p><a href="'. esc_url( get_permalink() ) . '">' . __( 'Read More', 'twentyeleven' ) . '</a></p>';
}

function cap_widget_tag_cloud_args( $args ) {
	$args['number'] = 20;
	$args['separator'] = ' ...';
	$args['smallest'] = 1;
	$args['largest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'cap_widget_tag_cloud_args' );

function cap_widgets_init() {

	register_widget( 'CAP_Testimonial_Widget' );

	register_sidebar( array(
		'name' => __( 'Short Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-s',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'cap_widgets_init' );

function cap_body_classes( $classes ) {

	if ( is_page_template( 'shortsidebar-page.php' ) )
		$classes = array_diff( $classes, ['singular'] );

	return $classes;
}
add_filter( 'body_class', 'cap_body_classes', 11 );


class CAP_Testimonial_Widget extends WP_Widget {

	function CAP_Testimonial_Widget() {
		$widget_ops = array( 'classname' => 'widget_cap_testimonial', 'description' => __( 'Use this widget to show a single random testimonial', 'twentyeleven' ) );
		$this->WP_Widget( 'widget_cap_testimonial', __( 'Testimonial Widget', 'twentyeleven' ), $widget_ops );
		$this->alt_option_name = 'widget_cap_testimonial';
	}

	function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = null;

		extract( $args, EXTR_SKIP );
		$title = $instance['title'];

		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		cap_do_testimonial();

		echo $after_widget;
		wp_reset_postdata();

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title']) ? esc_attr( $instance['title'] ) : '';
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'twentyeleven' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
	<?php
	}
}

add_image_size( 'sidebar_post_thumbnail', 325, 9999, false );

function cap_featured_image_in_sidebar () {
	$page_id = get_queried_object_id();
	echo get_the_post_thumbnail( $page_id, 'sidebar_post_thumbnail' );
}
add_action( 'dynamic_sidebar_before', 'cap_featured_image_in_sidebar' );