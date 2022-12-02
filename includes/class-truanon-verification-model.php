<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Model Class
 *
 * Handles adding model functionality to the admin pages
 * as well as the front pages.
 *
 * @package TruAnon Identity
 * @since 1.1
 */
if( !class_exists( 'TruAnon_Verification_Model' ) ) {

	class TruAnon_Verification_Model {
			
		/**
	     * Get All Option Data
	     * 
	     * handle to get all options data
	     * 
	     * @package TruAnon Identity
	     * @since 1.1
	     */
	    function get_all_option_data() {	    		        
			return get_option( TRUANON_VERIFICATION_OPTION );
	    }

	    /**
	     * Update All Option Data
	     * 
	     * handle to update all options data
	     * 
	     * @package TruAnon Identity
	     * @since 1.1
	     */
	    function update_all_option_data( $all_option_data = array() ) {
	    	return update_option( TRUANON_VERIFICATION_OPTION, $all_option_data );
		}
		
		/**
		 * TruAnon get token
		 * 
		 * @package TruAnon Identity
	     * @since 1.1
		 */
		function truanon_get_token( $user_name ) {
			
			$truanon_setting_data = $this->get_all_option_data();			
			$truanon_mode_type = isset( $truanon_setting_data['truanon_mode_type'] ) ? $truanon_setting_data['truanon_mode_type'] : "Sendbox";
			if( $truanon_mode_type == "Live" ) {
			    $private_key = isset( $truanon_setting_data['live_private_key'] ) ? $truanon_setting_data['live_private_key'] : "";
			    $service_id = isset( $truanon_setting_data['live_service_id'] ) ? $truanon_setting_data['live_service_id'] : "";
			    $api_url = TRUANON_VERIFICATION_LIVE_URL;
			} else {
			    $private_key = isset( $truanon_setting_data['private_key'] ) ? $truanon_setting_data['private_key'] : "";
			    $service_id = isset( $truanon_setting_data['service_id']) ? $truanon_setting_data['service_id'] : "";
			    $api_url = TRUANON_VERIFICATION_SANDBOX_URL;
			}
			
			$remote_url = $api_url.'/api/request_token?id='.$user_name.'&service='.$service_id;// GET TOKEN API CALL
			$args = array(
				'headers' => array(
					'Authorization' => 'Bearer '.$private_key,
				)
			);
			$result = wp_remote_get( $remote_url, $args );

			return $result;
		}
		/**
		 * Verify Profile
		 * 
		 * @package TruAnon Identity
	     * @since 1.1
		 */
		function truanon_verify_profile( $user_name, $token_id ) {
			
			$truanon_setting_data = $this->get_all_option_data();			
			$truanon_mode_type = isset( $truanon_setting_data['truanon_mode_type'] ) ? $truanon_setting_data['truanon_mode_type'] : "Sendbox";
			if( $truanon_mode_type == "Live" ) {
			    $private_key = isset( $truanon_setting_data['live_private_key'] ) ? $truanon_setting_data['live_private_key'] : "";
			    $service_id = isset( $truanon_setting_data['live_service_id'] ) ? $truanon_setting_data['live_service_id'] : "";
			    $api_url = TRUANON_VERIFICATION_LIVE_URL;
			} else {
			    $private_key = isset( $truanon_setting_data['private_key'] ) ? $truanon_setting_data['private_key'] : "";
			    $service_id = isset( $truanon_setting_data['service_id']) ? $truanon_setting_data['service_id'] : "";
			    $api_url = TRUANON_VERIFICATION_SANDBOX_URL;
			}

			$remote_url = $api_url.'/api/verifyProfile?id='.$user_name.'&service='.$service_id.'&token='.$token_id; // VERIFY API CALL
			$args = array(
				'headers'     => array(
					'Authorization' => 'Bearer '.$private_key,
				),
			); 
			$result = wp_remote_get( $remote_url, $args );

			return $result;
		}

		/**
		 * User GET Profile
		 * 
		 * @package TruAnon Identity
	     * @since 1.1
		 */
		function truanon_get_profile( $username ) {
			
			$truanon_setting_data = $this->get_all_option_data();
			$truanon_mode_type = isset( $truanon_setting_data['truanon_mode_type'] ) ? $truanon_setting_data['truanon_mode_type'] : "Sendbox";
			if( $truanon_mode_type == "Live" ) {
			    $private_key = isset( $truanon_setting_data['live_private_key'] ) ? $truanon_setting_data['live_private_key'] : "";
			    $service_id = isset( $truanon_setting_data['live_service_id'] ) ? $truanon_setting_data['live_service_id'] : "";
			    $api_url = TRUANON_VERIFICATION_LIVE_URL;
			} else {
			    $private_key = isset( $truanon_setting_data['private_key'] ) ? $truanon_setting_data['private_key'] : "";
			    $service_id = isset( $truanon_setting_data['service_id']) ? $truanon_setting_data['service_id'] : "";
			    $api_url = TRUANON_VERIFICATION_SANDBOX_URL;
			}

			$remote_url = $api_url.'/api/get_profile?id='.$username.'&service='.$service_id; // GET PROFILE URL API CALL
			$args = array(
				'headers'     => array(
					'Authorization' => 'Bearer '.$private_key,
				),
			); 
			$result = wp_remote_get( $remote_url, $args );
			
			return $result;
		}

		/**
		 * Escape Tags & Slashes
		 *
		 * Handles escapping the slashes and tags
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_escape_attr( $data ) {		
			return esc_attr( stripslashes( $data ) );
		}
		
		/**
		 * Stripslashes 
	 	 * 
	  	 * It will strip slashes from the content
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_escape_slashes_deep( $data = array(), $flag=false, $limited = false ) { 
			
			if( $flag != true ) {				
				$data = $this->truanon_nohtml_kses($data);				
			} else {				
				if( $limited == true ) {
					$data = wp_kses_post( $data );
				}				
			}
			
			$data = stripslashes_deep($data);
			return $data;
		}
		
		/**
		 * Strip Html Tags 
		 * 
		 * It will sanitize text input (strip html tags, and escape characters)
		 * 
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_nohtml_kses( $data = array() ) {			
			
			if ( is_array($data) ) {				
				$data = array_map( array( $this,'truanon_nohtml_kses' ), $data );
			} elseif ( is_string( $data ) ) {
				$data = wp_filter_nohtml_kses( $data );
			}
			
			return $data;
		}
	}
}