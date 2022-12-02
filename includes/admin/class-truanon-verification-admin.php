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
if( !class_exists( 'TruAnon_Verification_Admin' ) ) {
	
  	class TruAnon_Verification_Admin {
	
		/**
		 * Adding Setting Menu
		 *
		 * Adding function for Add Setting Menu.
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_verification_admin_menu() {
			add_menu_page( esc_html__('TruAnon Setting', 'ww_truanon_setting_page'), esc_html__('TruAnon Settings', 'ww_truanon_setting_page'), TRUANON_VERIFICATION_LEVEL, 'ww_truanon_setting_page', '','');

			add_submenu_page('ww_truanon_setting_page', esc_html__('TruAnon Settings', 'truanon-identity'), esc_html__('TruAnon Settings','truanon-identity'), TRUANON_VERIFICATION_LEVEL, 'ww_truanon_setting_page', array($this, 'truanon_verification_setting_page'));
		}

		/**
		 * Adding Settings PAGE
		 *
		 * Adding Settings PAGE For Settings Data Save
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_verification_setting_page() {			
			include_once( TRUANON_VERIFICATION_ADMIN . '/forms/ww-truanon-verification-setting.php');
		}

		
		/**
		 * Save TruAnon Settings Page
		 *
		 * Handles Function to TruAnon Settings Setting
		 * 
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function truanon_verification_admin_init() {
			include_once( TRUANON_VERIFICATION_ADMIN . '/forms/ww-truanon-verification-save.php');
		}

		/**
		 * Adding Hooks
		 *
		 * Adding hooks for the styles and scripts.
		 *
		 * @package TruAnon Identity
		 * @since 1.1
		 */
		function add_hooks() {
	        // add new admin menu page
			add_action( 'admin_menu', array( $this, 'truanon_verification_admin_menu' ) );
			
	        // Admin init for saving data
	        add_action( 'admin_init', array( $this, 'truanon_verification_admin_init' ) );
	    }
	}
}