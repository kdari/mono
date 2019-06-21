<?php
/**
 * Quintus Theme Options
 *
 * @package Quintus
 * @since Quintus 1.0
 */

/**
 * Properly enqueue styles and scripts for our theme options page.
 *
 * This function is attached to the admin_enqueue_scripts action hook.
 */
function quintus_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'quintus-theme-options', get_template_directory_uri() . '/inc/theme-options.css', false, '2011-04-28' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'quintus_admin_enqueue_scripts' );

/**
 * Init plugin options to white list our options
 */
function quintus_theme_options_init() {
	register_setting(
		'quintus_options', // Options group, see settings_fields() call in quintus_theme_options_render_page()
		'quintus_theme_options', // Database option, see quintus_get_theme_options()
		'quintus_theme_options_validate' // The sanitization callback, see quintus_theme_options_validate()
	);

	// Register our settings field group
	add_settings_section(
		'general', // Unique identifier for the settings section
		'', // Section title (we don't want one)
		'__return_false', // Section callback (we don't want anything)
		'theme_options' // Menu slug, used to uniquely identify the page; see quintus_theme_options_add_page()
	);

	// Register our individual settings fields
	add_settings_field(
		'color_scheme', // Unique identifier for the field for this section
		__( 'Color Schemes', 'quintus' ), // Setting field label
		'quintus_color_scheme', // Function that renders the settings field
		'theme_options', // Menu slug, used to uniquely identify the page; see quintus_theme_options_add_page()
		'general' // Settings section. Same as the first argument in the add_settings_section() above
	);
}
add_action( 'admin_init', 'quintus_theme_options_init' );

/**
 * Change the capability required to save the 'quintus_options' options group.
 *
 * @see quintus_theme_options_init() First parameter to register_setting() is the name of the options group.
 * @see quintus_theme_options_add_page() The edit_theme_options capability is used for viewing the page.
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */
function quintus_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_quintus_options', 'quintus_option_page_capability' );

/**
 * Load up the menu page
 */
function quintus_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Theme Options', 'quintus' ),   // Name of page
		__( 'Theme Options', 'quintus' ),   // Label in menu
		'edit_theme_options',               // Capability required
		'theme_options',                    // Menu slug, used to uniquely identify the page
		'quintus_theme_options_render_page' // Function that renders the options page
	);
}
add_action( 'admin_menu', 'quintus_theme_options_add_page' );

/**
 * Create the options page
 */
function quintus_theme_options_render_page() {
	?>
	<div class="wrap image-radio-option">
		<h2><?php printf( __( '%s Theme Options', 'quintus' ), wp_get_theme() ); ?></h2>
		<?php settings_errors(); ?>

		<form method="post" action="options.php">
			<?php
				settings_fields( 'quintus_options' );
				do_settings_sections( 'theme_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Return array for our radio option
 */
function quintus_color_scheme_options() {
	$color_scheme_options = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default', 'quintus' )
		),
		'archaic' => array(
			'value' => 'archaic',
			'label' => __( 'Archaic', 'quintus' )
		),
	);

	return apply_filters( 'quintus_color_scheme_options', $color_scheme_options );
}

/**
 *
 */
function quintus_color_scheme() {
	$options = get_option( 'quintus_theme_options' );
	?>
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e( 'Choose a Color', 'quintus' ); ?></span></legend>

		<?php foreach ( quintus_color_scheme_options() as $option ) : ?>
		<div class="layout">
			<label class="description">
				<input type="radio" name="quintus_theme_options[color_scheme]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['color_scheme'] ); ?> /> <?php echo $option['label']; ?>
				<span>
					<img src="<?php echo get_template_directory_uri() . '/inc/images/color-' . esc_attr( $option['value'] ) . '.png' ; ?>" width="200" height="147" alt="" />
				</span>
			</label>
		</div>
		<?php endforeach; ?>

	</fieldset>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function quintus_theme_options_validate( $input ) {

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['color_scheme'] ) )
		$input['color_scheme'] = null;
	if ( ! array_key_exists( $input['color_scheme'], quintus_color_scheme_options() ) )
		$input['color_scheme'] = null;

	return $input;
}
