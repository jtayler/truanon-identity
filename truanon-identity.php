<?php
/**
 * Plugin Name: TruAnon Identity
 * Plugin URI: https://truanon.com/get
 * Description:  A simple profile badge to let members visibly back their own claim of identity
 * Version: 2.0
 * Author: TruAnon
 * Author URI: https://truanon.com/get
 * Text Domain: truanon-verification
 * Domain Path: languages
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Define Constants
 */
if( !defined( 'TRUANON_VERIFICATION_VERSION' ) ) {
	define( 'TRUANON_VERIFICATION_VERSION', '1.1' ); //version of plugin
}
if( !defined( 'TRUANON_VERIFICATION_DIR' ) ) {
	define( 'TRUANON_VERIFICATION_DIR', dirname( __FILE__ ) ); // plugin dir
}
if( !defined( 'TRUANON_VERIFICATION_PUBLIC' ) ) {
	define( 'TRUANON_VERIFICATION_PUBLIC', TRUANON_VERIFICATION_DIR . '/includes/public' ); // plugin admin dir
}
if( !defined( 'TRUANON_VERIFICATION_LEVEL' ) ) { //check if variable is not defined previous then define its
	define( 'TRUANON_VERIFICATION_LEVEL','administrator' ); //this is capability in plugin
}
if( !defined( 'TRUANON_VERIFICATION_ADMIN' ) ) {
	define( 'TRUANON_VERIFICATION_ADMIN', TRUANON_VERIFICATION_DIR . '/includes/admin' ); // plugin admin dir
}
if( !defined( 'TRUANON_VERIFICATION_URL' ) ) {
	define( 'TRUANON_VERIFICATION_URL', plugin_dir_url( __FILE__ ) ); // plugin url
}
if ( !defined( 'TRUANON_VERIFICATION_OPTION') ) {
    define( 'TRUANON_VERIFICATION_OPTION', 'truanon_verification_options' ); // Option Name
}
if ( !defined( 'TRUANON_VERIFICATION_SANDBOX_URL') ) {
    define( 'TRUANON_VERIFICATION_SANDBOX_URL', 'https://staging.truanon.com' ); // Sandbox URL
}
if ( !defined( 'TRUANON_VERIFICATION_LIVE_URL') ) {
    define( 'TRUANON_VERIFICATION_LIVE_URL', 'https://truanon.com' ); // Live URL
}
/**
 * Plugin Activation hook
 * 
 * This hook will call when plugin will activate
 */
global $ww_truanon_verification_public, $ww_truanon_verification_script, $ww_truanon_verification_admin, $ww_truanon_verification_model;

// Model file to handle database queries 
require_once( TRUANON_VERIFICATION_DIR . '/includes/class-truanon-verification-model.php');
$ww_truanon_verification_model = new TruAnon_Verification_Model();

// Script file for CSS and Js 
require_once( TRUANON_VERIFICATION_DIR . '/includes/class-truanon-verification-scripts.php');
$ww_truanon_verification_script = new TruAnon_Verification_Script();
$ww_truanon_verification_script->add_hooks();

// Public file 
require_once( TRUANON_VERIFICATION_DIR . '/includes/class-truanon-verification-public.php');
$ww_truanon_verification_public = new TruAnon_Verification_Public();
$ww_truanon_verification_public->add_hooks();

// Admin file 
require_once( TRUANON_VERIFICATION_ADMIN . '/class-truanon-verification-admin.php');
$ww_truanon_verification_admin = new TruAnon_Verification_Admin();
$ww_truanon_verification_admin->add_hooks();

/**
 * Plugin Activation Hook
 */
register_activation_hook( __FILE__, 'truanon_verification_register_activation' );

function truanon_verification_register_activation() {
    
    global $ww_truanon_verification_model;
    $truanon_db_version = get_option( 'truanon_db_version' );
    if( empty( $truanon_db_version ) ) {
        // Set default data
        $truanon_default_options = array();
        $truanon_default_options['verify_text'] = 'Confirm';
        $truanon_default_options['not_verify_text'] = 'Not Confirm';
        $truanon_default_options['service_id'] = '';
        $truanon_default_options['badge1_description'] = '<div class="bsui btn-group truanon">
   <a target="_blank" href="https://truanon.com/p/{profile_url}" class="bsui btn btn-sm btn-{rank_color} mb-1 p-2">
   <span class="pr-1 far fa-check-circle"></span>{rank_title}
   </a>
   <a class="p-2 bsui btn btn-sm btn-{rank_color} mb-1 dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><span class="caret"></span></a>
   <div class="dropdown-menu" x-placement="bottom-start">
      <h1 class="font-weight-bold dropdown-header text-center">
         {profile_name}
      </h1>
      <h6 class="pb-2 font-weight-light text-center">
         ({rank_score} of 5)
      </h6>
      <div class="p-2 pb-4 font-weight-light text-center">
         This identity has been publicly confirmed using TruAnon.
      </div>
      <div class="dropdown-divider"></div>
      <a target="_blank" class="dropdown-item" href="https://truanon.com/p/{profile_url}">
      <span class="pr-1 far fa-check-circle"></span>
      Visit TruAnon Profile
      </a>
   </div>
</div>';

        $truanon_default_options['badge2_description'] = '<div class="btn-group truanon">
   <span class="disabled btn btn-sm btn-outline-dark mb-1 p-2">
   <span class="pr-1 far fa-check-circle"></span>Unconfirmed
   </span>
   <a class="p-2 btn btn-sm btn-outline-dark mb-1 dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><span class="caret"></span></a>
   <div class="dropdown-menu" x-placement="top-start">
      <h6 class="font-weight-bold dropdown-header text-center">
         Unconfirmed
      </h6>
      <div class="p-2 pb-4 font-weight-light text-center">
         This profile has not yet been confirmed by the owner. Caution is advised.
      </div>
   </div>
</div>';
        $truanon_default_options['not_confirm_txt'] = '<div class="bsui btn-group truanon">
   <a class="btn verify-btn btn-sm btn-info mb-1 p-2" width="480" height="820" top="327.5" left="489.5" data-url="{confirm_url}">
   <span class="pr-1 far fa-check-circle"></span>Confirm Your Profile
   </a>
   <a class="p-2 bsui btn-sm btn btn-info mb-1 dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><span class="caret"></span></a>
   <div class="dropdown-menu" x-placement="top-start">
      <h6 class="font-weight-bold dropdown-header text-center">
         Unconfirmed
      </h6>
      <div class="p-2 pb-4 font-weight-light text-center">
         You must confirm ownership of your profile.
      </div>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item verify-btn" width="480" height="820" top="327.5" left="489.5" data-url="{confirm_url}">
      <span class="pr-1 far fa-check-circle"></span>
      Confirm Your Profile
      </a>
   </div>
</div>';

        $oldOptions=$ww_truanon_verification_model->get_all_option_data( $truanon_default_options );
        if (!empty($oldOptions)){
          $fields=array('not_confirm_txt','badge1_description','badge2_description');
          foreach($fields AS $f){
            $oldOptions[$f]=$truanon_default_options[$f];
          }
          $ww_truanon_verification_model->update_all_option_data( $oldOptions );
        }
        else {
          $ww_truanon_verification_model->update_all_option_data( $truanon_default_options );
        }

        // update db version 
        update_option( 'truanon_db_version', '1.0.1' );
    }
}