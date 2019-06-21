<?php
/**
 * Loads all CSS and JS files that VFB Pro needs
 *
 * This class should be called when the menu is added
 * so the CSS and JS is added to ONLY our VFB Pro pages.
 *
 * @since      3.0
 */
class VFB_Pro_Scripts_Loader {

	/**
	 * Load CSS on VFB pages.
	 *
	 * @access public
	 * @return void
	 */
	public function add_css() {
		wp_enqueue_style( 'vfb-pro', VFB_PLUGIN_URL . "public/assets/css/vfb-style.min.css", array(), '2015.02.20' );
	}

	/**
	 * Load JS on VFB pages
	 *
	 * @access public
	 * @return void
	 */
	public function add_js() {
		wp_register_script( 'vfbp-js', VFB_PLUGIN_URL . "public/assets/js/vfb-js.min.js", array( 'jquery' ), '2015.03.19', true );
		wp_register_script( 'parsley-js', VFB_PLUGIN_URL . "public/assets/js/parsley.min.js", array( 'jquery' ), '2.0.5', true );
		wp_register_script( 'parsley-js-custom', VFB_PLUGIN_URL . "public/assets/js/parsley-custom.min.js", array( 'parsley-js' ), '1.0', true );
		wp_register_script( 'jquery-phoenix', VFB_PLUGIN_URL . "public/assets/js/jquery.phoenix.min.js", array( 'jquery' ), '1.2.1', true );
		wp_register_script( 'jquery-mask', VFB_PLUGIN_URL . "public/assets/js/jquery.mask.min.js", array( 'jquery' ), '1.10.12', true );
		wp_register_script( 'jquery-datepicker', VFB_PLUGIN_URL . "public/assets/js/datepicker.min.js", array( 'jquery' ), '1.3.0', true );
		wp_register_script( 'jquery-clockpicker', VFB_PLUGIN_URL . "public/assets/js/clockpicker.min.js", array( 'jquery' ), '0.0.7', true );
		wp_register_script( 'jquery-addressfield', VFB_PLUGIN_URL . "public/assets/js/addressfield.min.js", array( 'jquery' ), '0.2.1', true );
		wp_register_script( 'jquery-addressfield-json', VFB_PLUGIN_URL . "public/assets/js/addressfield.json", array( 'jquery-addressfield' ), '2015.02.07', true );
		wp_register_script( 'jquery-autonumeric', VFB_PLUGIN_URL . "public/assets/js/autoNumeric.min.js", array( 'jquery' ), '1.9.26', true );
		wp_register_script( 'jquery-intl-tel', VFB_PLUGIN_URL . "public/assets/js/intl-tel-input.min.js", array( 'jquery' ), '3.7.1', true );
		wp_localize_script( 'jquery-intl-tel', 'vfbp_phone_format', array( 'vfbp_phone_url' => VFB_PLUGIN_URL . "public/assets/js/phone-format.min.js" ) );
		wp_register_script( 'jquery-fileupload', VFB_PLUGIN_URL . "public/assets/js/fileinput.min.js", array( 'jquery' ), '2.9.1', true );
		wp_register_script( 'vfb-pw-meter', VFB_PLUGIN_URL . "public/assets/js/password-meter.min.js", array( 'jquery' ), '1.0', true );
		wp_register_script( 'vfb-iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), '1.0.4', true );
		wp_register_script( 'ion-range-slider', VFB_PLUGIN_URL . "public/assets/js/ion.rangeSlider.min.js", array( 'jquery' ), '2.0.2', true );
		wp_register_script( 'jquery-tokenize', VFB_PLUGIN_URL . "public/assets/js/jquery.tokenize.min.js", array( 'jquery' ), '2.2.1', true );
		wp_register_script( 'jquery-rating', VFB_PLUGIN_URL . "public/assets/js/rating-input.min.js", array( 'jquery' ), '0.2.5', true );
		wp_register_script( 'vfb-steps', VFB_PLUGIN_URL . "public/assets/js/page-break.min.js", array( 'jquery' ), '1.1.2', true );
		wp_register_script( 'google-recaptcha-v2', 'https://www.google.com/recaptcha/api.js', array(), '2.0', false );

		$datepicker_locales = array(
			'ar', 'az', 'bg', 'ca', 'cs', 'cy', 'da', 'de', 'el', 'es', 'et',
			'fa', 'fi', 'fr', 'gl', 'he', 'hr', 'hu', 'id', 'is', 'it', 'ja', 'ka', 'kk', 'kr',
			'lt', 'lv', 'mk', 'ms', 'nb', 'nl',	'nl-BE', 'no', 'pl', 'pt-BR', 'pt',
			'ro', 'rs', 'rs-lati', 'ru', 'sk', 'sl', 'sq', 'sv', 'sw', 'th', 'tr',
			'ua', 'vi', 'zh-CN', 'zh-TW',
		);

		foreach ( $datepicker_locales as $locale ) {
			wp_register_script( 'jquery-datepicker-i18n-' . $locale, VFB_PLUGIN_URL . "public/assets/js/i18n/datepicker/datepicker.{$locale}.js", array( 'jquery-datepicker' ), '1.3.0', true );
		}
	}
}