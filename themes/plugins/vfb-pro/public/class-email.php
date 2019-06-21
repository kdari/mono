<?php
/**
 * Handles the main email
 *
 * @since      3.0
 */
class VFB_Pro_Email {
	/**
	 * form_id
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $form_id;

	/**
	 * The main email message
	 *
	 * Set in the notification() method and
	 * used in the autoresponder() method
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $message;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
	}

	/**
	 * email function.
	 *
	 * @access public
	 * @return void
	 */
	public function email() {
		$form_id = $this->get_form_id();
		if ( !$form_id )
			return;

		// Save Form ID to pass to phpmailer()
		$this->form_id = $form_id;

		// Get all email settings
		$email_settings = $this->get_email_settings( $form_id );
		$vfb_settings   = $this->get_vfb_settings();
		$rule_settings  = $this->get_rule_settings( $form_id );

		// Setup phpmailer if SMTP is enabled in Settings
		add_action( 'phpmailer_init', array( $this, 'phpmailer' ) );

		// Save Entry
		$entry_id = $this->save_entry( $form_id );

		// Main Email
		$this->notification( $email_settings, $vfb_settings, $entry_id, $form_id );

		// Autoresponder Email
		$this->autoresponder( $email_settings, $vfb_settings, $entry_id, $form_id );

		// Email Rules
		$this->conditional_email( $email_settings, $vfb_settings, $rule_settings, $entry_id, $form_id );

		/**
		 * Action that fires after all emails have been processed
		 *
		 * Passes the Entry ID and Form ID
		 *
		 * @since 3.0.3
		 *
		 */
		do_action( 'vfbp_after_email', $entry_id, $form_id );
	}

	/**
	 * Send out the main email.
	 *
	 * @access public
	 * @param mixed $email_settings
	 * @param mixed $vfb_settings
	 * @param mixed $entry_id
	 * @param mixed $form_id
	 * @return void
	 */
	public function notification( $email_settings, $vfb_settings, $entry_id, $form_id ) {
		$templating   = new VFB_Pro_Templating();

		$from_name    = isset( $email_settings['from-name']  ) ? $email_settings['from-name']  : '';
		$reply_to     = isset( $email_settings['reply-to']   ) ? $email_settings['reply-to']   : '';
		$subject      = isset( $email_settings['subject']    ) ? $email_settings['subject']    : '';
		$email_to     = isset( $email_settings['email-to']   ) ? $email_settings['email-to']   : '';
		$from_email   = isset( $email_settings['from-email'] ) ? $email_settings['from-email'] : '';
		$cc           = isset( $email_settings['cc']         ) ? $email_settings['cc']         : '';
		$bcc          = isset( $email_settings['bcc']        ) ? $email_settings['bcc']        : '';

		$format       = isset( $email_settings['email-format']   ) ? $email_settings['email-format']   : 'html';
		$template     = isset( $email_settings['email-template'] ) ? $email_settings['email-template'] : $this->html_template();

		// Process template tags
		$template = $templating->general( $template, $entry_id, $form_id );
		$template = $templating->css( $template, $email_settings );
		$template = $templating->all_fields( $template, $format, $entry_id, $form_id );

		// Process HTML and CSS through Premailer
		$premailer = VFB_Pro_Premailer::html( $template );
		$template  = is_array( $premailer) ? $premailer['html'] : $template;

		// Set Plain Text template from Premailer response
		if ( 'html' !== $format ) {
			$template = is_array( $premailer ) ? $premailer['txt'] : $template;
		}

		// Wrap lines longer than 80 words to meet email standards
		$template = wordwrap( $template, 80 );

		// Save message to a global property for use in class
		$this->message = $template;

		// Process template tags on Subject
		$subject = $templating->general( $subject, $entry_id, $form_id );

		// Set content type to either HTML or Plain Text
		$content_type = 'html' == $format ? 'text/html' : 'text/plain';

		$use_no_reply = $this->no_reply( $vfb_settings );
		if ( $use_no_reply )
			$from_email = $use_no_reply;

		$headers[] = "From: $from_name <$from_email>";
		$headers[] = "Reply-To: $reply_to";
		$headers[] = "Content-Type: $content_type; charset=\"" . get_option('blog_charset') . "\"";

		if ( !empty( $cc ) )
			$headers[] = "Cc: $cc";

		if ( !empty( $bcc ) )
			$headers[] = "Bcc: $bcc";

		/**
		 * Filter whether or not to send notification email
		 *
		 * Passing a falsey value to the filter will effectively short-circuit
		 * sending the notification email.
		 *
		 * @since 3.0
		 *
		 */
		if ( apply_filters( 'vfbp_skip_notification', false, $form_id, $entry_id ) )
			return;

		$emails = explode( ',', $email_to );
		foreach ( $emails as $email ) {
			wp_mail( $email, $subject, $template, $headers );
		}
	}

	/**
	 * Send out the autoresponder email.
	 *
	 * @access public
	 * @param mixed $email_settings
	 * @param mixed $vfb_settings
	 * @param mixed $entry_id
	 * @param mixed $form_id
	 * @return void
	 */
	public function autoresponder( $email_settings, $vfb_settings, $entry_id, $form_id ) {
		$templating = new VFB_Pro_Templating();

		$from_email = isset( $email_settings['from-email']        ) ? $email_settings['from-email']        : '';
		$name       = isset( $email_settings['notify-name']       ) ? $email_settings['notify-name']       : '';
		$email      = isset( $email_settings['notify-email']      ) ? $email_settings['notify-email']      : '';
		$subject    = isset( $email_settings['notify-subject']    ) ? $email_settings['notify-subject']    : '';
		$email_to   = isset( $email_settings['notify-email-to']   ) ? $email_settings['notify-email-to']   : '';
		$message    = isset( $email_settings['notify-message']    ) ? $email_settings['notify-message']    : '';
		$entry_copy = isset( $email_settings['notify-entry-copy'] ) ? $email_settings['notify-entry-copy'] : '';
		$format     = isset( $email_settings['email-format']      ) ? $email_settings['email-format']      : 'html';

		// If no email is set, don't bother trying to send
		if ( empty( $email_to ) )
			return;

		// Set Email To var by checking $_POST + field ID
		if ( !empty( $email_to ) ) {
			$email_data = isset( $_POST[ 'vfb-field-' . $email_to ] ) ? $_POST[ 'vfb-field-' . $email_to ] : '';
			$email_to   = sanitize_email( esc_html( $email_data ) );
		}

		// Process template tags
		$message = $templating->general( $message, $entry_id, $form_id );

		// Process template tags on Subject
		$subject = $templating->general( $subject, $entry_id, $form_id );

		// Set content type to either HTML or Plain Text
		$content_type = 'html' == $format ? 'text/html' : 'text/plain';

		// Process HTML and CSS through Premailer
		$premailer = VFB_Pro_Premailer::html( $message );
		$message   = is_array( $premailer) ? $premailer['html'] : $message;

		// Strip HTML tags if sending plain text
		if ( 'html' !== $format ) {
			$message = is_array( $premailer ) ? $premailer['txt'] : $message;
		}

		// Wrap lines longer than 80 words to meet email standards
		$message = wordwrap( $message, 80 );

		$use_no_reply = $this->no_reply( $vfb_settings );
		if ( $use_no_reply )
			$from_email = $use_no_reply;

		// Prepend autoresponder message
		if ( !empty( $entry_copy ) )
			$message .= $this->message;

		$headers[] = "From: $name <$from_email>";
		$headers[] = "Reply-To: $email";
		$headers[] = "Content-Type: $content_type; charset=\"" . get_option('blog_charset') . "\"";

		/**
		 * Filter whether or not to send autoresponder email
		 *
		 * Passing a falsey value to the filter will effectively short-circuit
		 * sending the autoresponder email.
		 *
		 * @since 3.0
		 *
		 */
		if ( apply_filters( 'vfbp_skip_autoresponder', false, $form_id, $entry_id ) )
			return;

		wp_mail( $email_to, $subject, $message, $headers );
	}

	/**
	 * Send out emails based on Email Rules.
	 *
	 * @access public
	 * @param mixed $email_settings
	 * @param mixed $vfb_settings
	 * @param mixed $rules
	 * @param mixed $entry_id
	 * @param mixed $form_id
	 * @return void
	 */
	public function conditional_email( $email_settings, $vfb_settings, $rules, $entry_id, $form_id ) {
		$enable      = isset( $rules['rules-email-enable'] ) ? $rules['rules-email-enable'] : '';

		if ( empty( $enable ) )
			return;

		$templating  = new VFB_Pro_Templating();
		$rules_email = isset( $rules['rules-email']  ) ? $rules['rules-email']  : '';
		$from_name   = isset( $email_settings['from-name']    ) ? $email_settings['from-name']    : '';
		$reply_to    = isset( $email_settings['reply-to']     ) ? $email_settings['reply-to']     : '';
		$subject     = isset( $email_settings['subject']      ) ? $email_settings['subject']      : '';
		$from_email  = isset( $email_settings['from-email']   ) ? $email_settings['from-email']   : '';
		$format      = isset( $email_settings['email-format'] ) ? $email_settings['email-format'] : 'html';
		$message     = $this->message;

		// Process template tags on Subject
		$subject = $templating->general( $subject, $entry_id, $form_id );

		// Set content type to either HTML or Plain Text
		$content_type = 'html' == $format ? 'text/html' : 'text/plain';

		$use_no_reply = $this->no_reply( $vfb_settings );
		if ( $use_no_reply )
			$from_email = $use_no_reply;

		$headers[] = "From: $from_name <$from_email>";
		$headers[] = "Reply-To: $reply_to";
		$headers[] = "Content-Type: $content_type; charset=\"" . get_option('blog_charset') . "\"";

		/**
		 * Filter whether or not to send emails set by the Email Rules
		 *
		 * Passing a falsey value to the filter will effectively short-circuit
		 * sending any email set by the Email Rules.
		 *
		 * @since 3.0
		 *
		 */
		if ( apply_filters( 'vfbp_skip_conditional_email', false, $form_id, $entry_id ) )
			return;

		if ( is_array( $rules_email ) && !empty( $rules_email ) ) {
			$conditions = $rules_email[0]['conditions'];

			foreach ( $conditions as $condition ) {
				$email   = sanitize_email( $condition['email'] );
				$id      = $condition['field-id'];
				$filter  = $condition['filter'];
				$value   = $condition['value'];
				$data    = isset( $_POST['vfb-field-' . $id ] ) ? stripslashes( $_POST['vfb-field-' . $id ] ) : '';

				switch ( $filter ) {
					case 'is' :
						if ( !empty( $data ) && $data == $value )
							wp_mail( $email, $subject, $message, $headers );
						break;

					case 'is not' :
						if ( !empty( $data ) && $data !== $value )
							wp_mail( $email, $subject, $message, $headers );
						break;

					case 'contains' :
						if ( !empty( $data ) && strpos( $data, $value ) !== false )
							wp_mail( $email, $subject, $message, $headers );
						break;

					case 'does not contain' :
						if ( !empty( $data ) && strpos( $data, $value ) === false )
							wp_mail( $email, $subject, $message, $headers );
						break;

					case 'begins with' :
						if ( !empty( $data ) && substr( $data, 0, strlen( $value ) ) == $value )
							wp_mail( $email, $subject, $message, $headers );
						break;

					case 'ends with' :
						$length = strlen( $value );
						if ( !empty( $data ) && substr( $data, -$length, $length ) == $value )
							wp_mail( $email, $subject, $message, $headers );
						break;
				}
			}
		}
	}

	/**
	 * Check if a no-reply email needs to be set
	 *
	 * @access private
	 * @param mixed $settings
	 * @return void
	 */
	private function no_reply( $settings ) {
		$smtp_host = isset( $settings['smtp-host'] ) ? $settings['smtp-host'] : '';
		$smtp_port = isset( $settings['smtp-port'] ) ? $settings['smtp-port'] : '';

		if ( !empty( $smtp_host ) && !empty( $smtp_port ) )
			return false;

		// Get the site domain and get rid of www.
		$sitename = strtolower( $_SERVER['SERVER_NAME'] );
		if ( substr( $sitename, 0, 4 ) == 'www.' ) {
			$sitename = substr( $sitename, 4 );
		}

		return 'no-reply@' . $sitename;
	}

	/**
	 * save_entry function.
	 *
	 * @access public
	 * @param mixed $form_id
	 * @return void
	 */
	public function save_entry( $form_id ) {
		$entry = new VFB_Pro_Save_Entry();
		$id = $entry->create( $form_id );

		return $id;
	}

	/**
	 * Use the PHPMailer class, if configured to do so.
	 *
	 * @access public
	 * @param mixed $phpmailer
	 * @return void
	 */
	public function phpmailer( $phpmailer ) {
		$vfb_settings   = $this->get_vfb_settings();
		$email_settings = $this->get_email_settings( $this->form_id );

		$smtp_host         = isset( $vfb_settings['smtp-host']       ) ? $vfb_settings['smtp-host']       : '';
		$smtp_port         = isset( $vfb_settings['smtp-port']       ) ? $vfb_settings['smtp-port']       : '';
		$smtp_encryption   = isset( $vfb_settings['smtp-encryption'] ) ? $vfb_settings['smtp-encryption'] : '';
		$smtp_auth         = isset( $vfb_settings['smtp-auth']       ) ? $vfb_settings['smtp-auth']       : '';
		$smtp_username     = isset( $vfb_settings['smtp-username']   ) ? $vfb_settings['smtp-username']   : '';
		$smtp_password     = isset( $vfb_settings['smtp-password']   ) ? $vfb_settings['smtp-password']   : '';

		$from_name         = isset( $email_settings['from-name']     ) ? $email_settings['from-name']     : '';
		$from_email        = isset( $email_settings['from-email']    ) ? $email_settings['from-email']    : '';

		// Exit if Host and Port aren't set
		if ( empty( $smtp_host ) && empty( $smtp_port ) )
			return;

		// Tell the PHPMailer class to use SMTP
		$phpmailer->isSMTP();

		// Set the Host and Port number
	    $phpmailer->Host = $smtp_host;
	    $phpmailer->Port = $smtp_port;

	    // If we're using smtp auth, set the username & password
	    if ( $smtp_auth ) {
		    // Set the SMTPSecure value, if set to none, leave this blank
			$phpmailer->SMTPSecure = $smtp_encryption == 'none' ? '' : $smtp_encryption;
			$phpmailer->SMTPAuth   = true;
		    $phpmailer->Username   = $smtp_username;
		    $phpmailer->Password   = $smtp_password;
	    }

	    // Set the From email and name header
	    if ( !empty( $from_name ) && !empty( $from_email ) ) {
		    $phpmailer->From     = $from_email;
		    $phpmailer->FromName = $from_name;
	    }
	}

	/**
	 * The default HTML template
	 *
	 * @access private
	 * @param mixed $setting
	 * @return void
	 */
	private function html_template() {
		ob_start();

		require_once( VFB_PLUGIN_DIR . 'inc/preview-email.php' );

		$template = ob_get_clean();

		return $template;
	}

	/**
	 * get_vfb_settings function.
	 *
	 * @access private
	 * @param mixed $id
	 * @return void
	 */
	private function get_vfb_settings() {
		$vfbdb = new VFB_Pro_Data();
		$settings = $vfbdb->get_vfb_settings();

		return $settings;
	}

	/**
	 * get_email_settings function.
	 *
	 * @access private
	 * @param mixed $id
	 * @return void
	 */
	private function get_email_settings( $id ) {
		$vfbdb = new VFB_Pro_Data();
		$settings = $vfbdb->get_email_settings( $id );

		return $settings;
	}

	/**
	 * get_rule_settings function.
	 *
	 * @access private
	 * @param mixed $id
	 * @return void
	 */
	private function get_rule_settings( $id ) {
		$vfbdb = new VFB_Pro_Data();
		$settings = $vfbdb->get_rule_settings( $id );

		return $settings;
	}

	/**
	 * Get form ID
	 *
	 * @access private
	 * @return void
	 */
	private function get_form_id() {
		if ( !isset( $_POST['_vfb-form-id'] ) )
			return false;

		return (int) $_POST['_vfb-form-id'];
	}

	/**
	 * Basic check to exit if the form hasn't been submitted
	 *
	 * @access public
	 * @return void
	 */
	public function submit_check() {
		// If form ID hasn't been submitted by $_POST, exit
		if ( !$this->get_form_id() )
			return;

		return true;
	}
}