<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Pulic Class
 * 
 * Handles TruAnon Identity
 *
 * @package TruAnon Identity
 * @since 1.1
 */
if( !class_exists( 'TruAnon_Verification_Public' ) ) {

	class TruAnon_Verification_Public {

		public $model;

		public function __construct() {

			global $ww_truanon_verification_model;

			$this->model = $ww_truanon_verification_model;
		}
		
		/**
		 * Adding Short Code Function
		 *
		 * Adding Short Code Html Using Included File
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
        public function wp_truanon_process_shortcode( $atts, $content ) {
        	$trunanon_user_id = isset( $atts['userid'] ) ? $atts['userid'] : "";
			$trunanon_user_name = isset( $atts['username'] ) ? $atts['username'] : "";
        	$html ="";
			
			// Check User id is not empty
        	if( is_user_logged_in() || $trunanon_user_id != "" ) {
				ob_start();
				include( TRUANON_VERIFICATION_PUBLIC . '/forms/ww-truanon-profile-display.php');
				$html = ob_get_clean();
			}
			return $html;
		}
		
		/**
		 * Adding Jquery Ajax Call
		 *
		 * Adding function for JQuery Ajax for Profile Verification
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		public function wp_truanon_verify_profile($attr) {		
		
			$user_name = $attr['username'];
			$result = $this->model->truanon_get_token( $user_name ); 
			
			$truanon_setting_data = $this->model->get_all_option_data();			
			$truanon_mode_type = isset( $truanon_setting_data['truanon_mode_type'] ) ? $truanon_setting_data['truanon_mode_type'] : "Sendbox";

			if( $truanon_mode_type == "Live" ) {
			    $api_url = TRUANON_VERIFICATION_LIVE_URL;
			    $service_id = isset( $truanon_setting_data['live_service_id'] ) ? $truanon_setting_data['live_service_id'] : "";
			} else {
			    $api_url = TRUANON_VERIFICATION_SANDBOX_URL;
			    $service_id = isset( $truanon_setting_data['service_id']) ? $truanon_setting_data['service_id'] : "";
			}
			
			if( !empty( $result ) ) {
				if( $result['response']['code'] == '200' && $result['response']['message'] == 'OK' ) {
					
					$response_data = isset( $result['body'] ) ? $result['body'] : "";
					if( !empty( $response_data ) ) {
						
						// SUCCESSFUL TOKEN GET PART
						$response_data =json_decode( $response_data );
						$token_id = $response_data->id;

						$verify_result = $this->model->truanon_verify_profile( $user_name, $token_id );
						$remote_url = $api_url.'/api/verifyProfile?id='.$user_name.'&service='.$service_id.'&token='.$token_id;
	
						if( $verify_result['response']['code'] == '200' && $verify_result['response']['message'] == 'OK' ) {
							return $remote_url; 
							exit;
						}						
					} else {
						return "";
						exit;
					}
				}
			} else {
				return "";
				exit;
			}
			

			return "";
			exit;
		}

		/**
		 * Adding Hooks
		 *
		 * @package TruAnon Identity
		 * @since 1.0
		 */
		function add_hooks() {

			// TruAnon shortcode
			add_shortcode( 'truanon_verification', array( $this, 'wp_truanon_process_shortcode' ) );
			
			// Ajax on click of verify profile
			add_shortcode( 'truanon_verify_profile', array( $this, 'wp_truanon_verify_profile' ) );
     	
		}
	}
}