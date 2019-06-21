<?php
/**
 * Class that displays all Admin Notices after saving
 *
 * @since 3.0
 */
class VFB_Pro_Admin_Notices {
	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_notices', array( $this, 'edit_fields' ) );
		add_action( 'admin_notices', array( $this, 'form_settings' ) );
		add_action( 'admin_notices', array( $this, 'email_settings' ) );
		add_action( 'admin_notices', array( $this, 'confirmation_settings' ) );
		add_action( 'admin_notices', array( $this, 'email_design_settings' ) );
		add_action( 'admin_notices', array( $this, 'rules_settings' ) );
		add_action( 'admin_notices', array( $this, 'addon_settings' ) );
		add_action( 'admin_notices', array( $this, 'vfb_settings' ) );
		add_action( 'admin_notices', array( $this, 'trash_form' ) );
		add_action( 'admin_notices', array( $this, 'duplicate_form' ) );
		add_action( 'admin_notices', array( $this, 'restore_form' ) );
		add_action( 'admin_notices', array( $this, 'delete_form' ) );
	}

	/**
	 * Edit Fields tab
	 *
	 * @access public
	 * @return void
	 */
	public function edit_fields() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-fields' !== $_POST['_vfbp_action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Field settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Form Settings tab
	 *
	 * @access public
	 * @return void
	 */
	public function form_settings() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-form-settings' !== $_POST['_vfbp_action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Form settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Email Settings tab
	 *
	 * @access public
	 * @return void
	 */
	public function email_settings() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-email-settings' !== $_POST['_vfbp_action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Email settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Confirmation Settings tab
	 *
	 * @access public
	 * @return void
	 */
	public function confirmation_settings() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-confirmation-settings' !== $_POST['_vfbp_action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Confirmation settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Email Design tab
	 *
	 * @access public
	 * @return void
	 */
	public function email_design_settings() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-design-settings' !== $_POST['_vfbp_action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Email Design settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Rules tab
	 *
	 * @access public
	 * @return void
	 */
	public function rules_settings() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-rules-settings' !== $_POST['_vfbp_action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Rules settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Add-on tab
	 *
	 * @access public
	 * @return void
	 */
	public function addon_settings() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-addon-settings' !== $_POST['_vfbp_action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Add-on settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Settings page
	 *
	 * @access public
	 * @return void
	 */
	public function vfb_settings() {
		if ( !$this->submit_check() )
			return;

		if ( 'save-settings' !== $_POST['_vfbp_action'] )
			return;

		// Special case to handle the Uninstall Plugin button
		if ( isset( $_POST['vfbp-uninstall'] ) ) {
			echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'VFB Pro has been successfully uninstalled.' , 'vfb-pro' ) );
			return;
		}

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Settings saved.' , 'vfb-pro' ) );
	}

	/**
	 * Trash form link was clicked
	 *
	 * @access public
	 * @return void
	 */
	public function trash_form() {
		if ( !isset( $_GET['vfb-action'] ) )
			return;

		if ( 'trash-form' !== $_GET['vfb-action'] )
			return;

		$form_id = isset( $_GET['form'] ) ? absint( $_GET['form'] ) : '';

		$undo_url = add_query_arg(
			array(
				'page'       => 'vfb-pro',
				'vfb-action' => 'restore',
				'form'       => $form_id,
			),
			wp_nonce_url( admin_url( 'admin.php' ), 'vfbp_undo_trash' )
		);

		$undo = !empty( $form_id ) ? sprintf( '<a href="%s">%s</a>', $undo_url, __( 'Undo', 'vfb-pro' ) ) : '';

		echo sprintf( '<div id="message" class="updated"><p>%s %s</p></div>', __( 'Item moved to the trash.' , 'vfb-pro' ), $undo );
	}

	/**
	 * Duplicate form link was clicked
	 *
	 * @access public
	 * @return void
	 */
	public function duplicate_form() {
		if ( !isset( $_GET['vfb-action'] ) )
			return;

		if ( 'duplicate-form' !== $_GET['vfb-action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Item successfully duplicated.' , 'vfb-pro' ) );
	}

	/**
	 * Undo trash link was clicked
	 *
	 * @access public
	 * @return void
	 */
	public function restore_form() {
		if ( !isset( $_GET['vfb-action'] ) )
			return;

		if ( 'restore' !== $_GET['vfb-action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Item restored from the Trash.' , 'vfb-pro' ) );
	}

	/**
	 * Undo trash link was clicked
	 *
	 * @access public
	 * @return void
	 */
	public function delete_form() {
		if ( !isset( $_GET['vfb-action'] ) )
			return;

		if ( 'delete' !== $_GET['vfb-action'] )
			return;

		echo sprintf( '<div id="message" class="updated"><p>%s</p></div>', __( 'Item permanently deleted.' , 'vfb-pro' ) );
	}

	/**
	 * Basic check to exit if the form hasn't been submitted
	 *
	 * @access public
	 * @return void
	 */
	public function submit_check() {
		if ( !isset( $_POST['_vfbp_action'] ) )
			return;

		$pages = array(
			'vfb-pro',
			'vfb-add-new',
			'vfbp-settings',
		);

		if ( !in_array( $_GET['page'], $pages ) )
			return;

		return true;
	}
}