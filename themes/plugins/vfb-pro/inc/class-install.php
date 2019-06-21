<?php
/**
 * Define the install process
 *
 * Installs the DB
 *
 * @since      3.0
 */
class VFB_Pro_Install {

	/**
	 * The database character set
	 *
	 * @since    3.0
	 * @access   private
	 * @var      string    $charset    The database character set
	 */
	private $charset;

	/**
	 * The database collation
	 *
	 * @since    3.0
	 * @access   private
	 * @var      string    $collate    The database collation
	 */
	private $collate;

	/**
	 * Initial setup
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->set_charset();
		$this->set_collate();
	}

	/**
	 * Check database version and run SQL install, if needed
	 *
	 * @access	public
	 * @since	3.0
	 */
	public function upgrade_db_check() {

		$current_db_version = VFB_DB_VERSION;

		if ( get_site_option( 'vfbp_db_version' ) != $current_db_version )
			$this->install_db();
	}

	/**
	 * Install everything VFB Pro will need such as settings and database tables
	 *
	 * @access	static
	 * @since   3.0
	 */
	public function install_db() {
		global $wpdb;

		$charset = $this->charset;
		$collate = $this->collate;

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		// Forms table
		$sql = "CREATE TABLE " . VFB_FORMS_TABLE_NAME . " (
			id BIGINT(20) NOT NULL AUTO_INCREMENT,
			title TEXT NOT NULL,
			data LONGTEXT CHARACTER SET utf8 NOT NULL,
			status VARCHAR(20) DEFAULT 'publish',
			date_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id)
		) DEFAULT CHARACTER SET {$charset} COLLATE {$collate};";

		dbDelta( $sql );

		// Fields table
		$sql = "CREATE TABLE " . VFB_FIELDS_TABLE_NAME . " (
			id BIGINT(20) NOT NULL AUTO_INCREMENT,
			form_id BIGINT(20) NOT NULL,
			field_type VARCHAR(255) CHARACTER SET utf8 NOT NULL,
			field_order BIGINT(20) NOT NULL,
			data LONGTEXT CHARACTER SET utf8 NOT NULL,
			PRIMARY KEY  (id)
		) DEFAULT CHARACTER SET {$charset} COLLATE {$collate};";

		dbDelta( $sql );

		// Form Meta table
	 	$sql = "CREATE TABLE ". VFB_FORM_META_TABLE_NAME . " (
			id BIGINT(20) NOT NULL AUTO_INCREMENT,
			form_id BIGINT(20) NOT NULL,
			meta_key VARCHAR(255) NOT NULL,
			meta_value LONGTEXT NOT NULL,
			PRIMARY KEY  (id)
		) DEFAULT CHARACTER SET {$charset} COLLATE {$collate};";

		dbDelta( $sql );

		update_option( 'vfbp_db_version', VFB_DB_VERSION );
	}

	/**
	 * Add or update the custom VFB capabilities
	 *
	 * @access	static
	 * @since   3.0
	 */
	public function add_caps() {
		$role = get_role( 'administrator' );

		// If the capabilities have not been added, do so here
		if ( !empty( $role ) && !$role->has_cap( 'vfb_uninstall_plugin' ) ) {
			// Setup the capabilities for each role that gets access
			$caps = array(
				'administrator' => array(
					'vfb_create_forms',
					'vfb_edit_forms',
					'vfb_copy_forms',
					'vfb_delete_forms',
					'vfb_import_forms',
					'vfb_export_forms',
					'vfb_view_entries',
					'vfb_edit_entries',
					'vfb_delete_entries',
					'vfb_edit_email_design',
					'vfb_view_analytics',
					'vfb_edit_settings',
					'vfb_uninstall_plugin',
				),
				'editor' => array(
					'vfb_view_entries',
					'vfb_edit_entries',
					'vfb_delete_entries',
					'vfb_view_analytics',
				)
			);

			// Assign the appropriate caps to the administrator role
			if ( !empty( $role ) ) {
				foreach ( $caps['administrator'] as $cap ) {
					$role->add_cap( $cap );
				}
			}

			// Assign the appropriate caps to the editor role
			$role = get_role( 'editor' );
			if ( !empty( $role ) ) {
				foreach ( $caps['editor'] as $cap ) {
					$role->add_cap( $cap );
				}
			}
		}
	}

	/**
	 * Add our Preview Page in draft
	 *
	 * @since  3.0
	 * @access public
	 * @return void
	 */
	public function add_preview_page() {
		$title        = 'VFB Pro - Form Preview';
		$preview_page = get_page_by_title( $title );

		if ( !$preview_page ) {
			$preview_post = array(
				'post_title'   => $title,
				'post_content' => 'This is a preview of how this form will appear on your website',
				'post_status'  => 'draft',
				'post_type'    => 'page',
			);

			// Insert the page
			$page_id = wp_insert_post( $preview_post );
		}
		else {
			$page_id = $preview_page->ID;
		}

		$data = get_option( 'vfbp_settings' );
		$data['preview-id'] = $page_id;

		update_option( 'vfbp_settings', $data );
	}

	/**
	 * Add our Preview Page in draft
	 *
	 * @since  3.0
	 * @access public
	 * @return void
	 */
	public function add_email_preview_page() {
		$title        = 'VFB Pro - Email Preview';
		$preview_page = get_page_by_title( $title );

		if ( !$preview_page ) {
			$preview_post = array(
				'post_title'   => $title,
				'post_content' => 'This is a preview of how the email will look.',
				'post_status'  => 'draft',
				'post_type'    => 'page',
			);

			// Insert the page
			$page_id = wp_insert_post( $preview_post );
		}
		else {
			$page_id = $preview_page->ID;
		}

		$data = get_option( 'vfbp_settings' );
		$data['email-preview-id'] = $page_id;

		update_option( 'vfbp_settings', $data );
	}

	/**
	 * A wrapper to check DB version which then calls install_db
	 *
	 * @since    3.0
	 */
	public function install() {
		$this->upgrade_db_check();
		$this->add_caps();
		$this->add_preview_page();
		$this->add_email_preview_page();
	}

	/**
	 * Set the database character set to utf8 or whatever DB_CHARSET is
	 *
	 * @since    3.0
	 */
	public function set_charset() {

		if ( defined( 'DB_CHARSET' ) && '' !== DB_CHARSET )
			$this->charset = DB_CHARSET;
		else
			$this->charset = 'utf8';
	}

	/**
	 * Set the database collation to utf8_general_ci or whatever DB_COLLATE is
	 *
	 * @since    3.0
	 */
	public function set_collate() {

		if ( defined( 'DB_COLLATE' ) && '' !== DB_COLLATE )
			$this->collate = DB_COLLATE;
		else
			$this->collate = 'utf8_general_ci';
	}

}