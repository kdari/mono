<?php
/**
 * @package Catch Themes
 * @subpackage Catch Everest
 * @since Catch Everest 2.5
 */


if( ! function_exists( 'catcheverest_is_feed_url_present' ) ) :
	/**
	* Return true if feed url is present
	*
	* @since Catch Everest 2.5
	*/
	function catcheverest_is_feed_url_present( $control ) {
		global $catcheverest_options_settings;

    	$options = $catcheverest_options_settings;

		return ( isset( $options['feed_url'] ) && '' != $options['feed_url'] );
	}
endif;


if( ! function_exists( 'catcheverest_is_header_code_present' ) ) :
	/**
	* Return true if header code is present
	*
	* @since Catch Everest 2.5
	*/
	function catcheverest_is_header_code_present( $control ) {
		global $catcheverest_options_settings;

    	$options = $catcheverest_options_settings;

		return ( isset( $options['analytic_header'] ) && '' != $options['analytic_header'] );
	}
endif;


if( ! function_exists( 'catcheverest_is_footer_code_present' ) ) :
	/**
	* Return true if footer code is present
	*
	* @since Catch Everest 2.5
	*/
	function catcheverest_is_footer_code_present( $control ) {
		global $catcheverest_options_settings;

    	$options = $catcheverest_options_settings;

		return ( isset( $options['analytic_footer'] ) && '' != $options['analytic_footer'] );
	}
endif;
