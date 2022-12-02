<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Scripts Class
 *
 * Handles adding scripts functionality to the admin pages
 * as well as the front pages.
 *
 * @package TruAnon Identity
 * @since 1.1
 */
if( !class_exists( 'TruAnon_Verification_Script' ) ) {
	
  class TruAnon_Verification_Script {
	
		/**
		 * Adding Script and style
		 *
		 * Adding function for the styles and scripts In Front Side.
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_verification_frontend_scripts() {			
			
			// Styles
			wp_enqueue_style( 'tru_anon_custom_css', TRUANON_VERIFICATION_URL . 'includes/css/custom.css', array(), TRUANON_VERIFICATION_VERSION );
			
			//Scripts
			wp_register_script( 'truanon_frontend_custom_js', TRUANON_VERIFICATION_URL . 'includes/js/public-custom.js', array('jquery'), TRUANON_VERIFICATION_VERSION, true );
			wp_enqueue_script( 'truanon_frontend_custom_js' );			
			wp_localize_script(
				'truanon_frontend_custom_js', 
				'WpTruAnonVerification', 
				array(
					'ajaxurl' => admin_url('admin-ajax.php', ( is_ssl() ? 'https' : 'http')) 
				)
			);
		}

		/**
		 * Adding Script and style
		 *
		 * Adding function for the styles and scripts In Admin Side.
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_verification_admin_scripts( $hooks_suffix ) {
			
			if( $hooks_suffix == "toplevel_page_ww_truanon_setting_page" ) { 
				
				wp_enqueue_media();
				
				// Backend admin scripts				
				wp_register_script( 'truanon_admin_custom_js', TRUANON_VERIFICATION_URL . 'includes/js/admin-custom.js', array('jquery'), TRUANON_VERIFICATION_VERSION, true );
				wp_enqueue_script( 'truanon_admin_custom_js' );
			}			
		}

		/**
		 * Adding Hooks
		 *
		 * Adding hooks for the styles and scripts.
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		public function add_hooks() {
			  
			// For Frontend scripts	
			add_action( 'wp_enqueue_scripts', array( $this, 'truanon_verification_frontend_scripts') );
					  
			// For Admin scripts
		  	add_action( 'admin_enqueue_scripts', array( $this, 'truanon_verification_admin_scripts' ) );
		}
	}
}