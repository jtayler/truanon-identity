<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Save TruAnon Settings Data
 *
 * Handle option save and edit TruAnon Settings Data
 * 
 * @package TruAnon Identity
 * @since 1.1
 */
global $ww_truanon_verification_model;

if ( isset( $_POST['truanon_save_options_field'] ) && 
    wp_verify_nonce( $_POST['truanon_save_options_field'], 'truanon_save_options' ) && 
    !empty( $_POST['tru_anon_setting'] ) ) {    
    
    $all_options = array();
    
    // Sanitize text values before save
    $all_options['truanon_mode_type'] = isset( $_POST['ww_truanon_option']['truanon_mode_type'] ) ? sanitize_text_field( $_POST['ww_truanon_option']['truanon_mode_type'] ) : "";
    $all_options['live_private_key'] = isset(  $_POST['ww_truanon_option']['live_private_key'] ) ?  sanitize_text_field( $_POST['ww_truanon_option']['live_private_key'] ) : ""; 
    $all_options['live_service_id'] = isset( $_POST['ww_truanon_option']['live_service_id'] ) ? sanitize_text_field( $_POST['ww_truanon_option']['live_service_id'] ) : "";

    $all_options['private_key'] = isset( $_POST['ww_truanon_option']['private_key'] ) ? sanitize_text_field( $_POST['ww_truanon_option']['private_key'] ) : "" ;
    
    $all_options['service_id'] = isset( $_POST['ww_truanon_option']['service_id'] ) ? sanitize_text_field( $_POST['ww_truanon_option']['service_id'] ) : "";

    // Sanitize editor
    $all_options['badge2_description'] = @trim( $_POST['ww_truanon_option']['badge2_description'] );
    $all_options['badge1_description'] = @trim( $_POST['ww_truanon_option']['badge1_description'] );
    $all_options['not_confirm_txt'] = @trim( $_POST['ww_truanon_option'][ 'not_confirm_txt']);
    // Save all data after sanitizing all values
    $ww_truanon_verification_model->update_all_option_data( $all_options );// UPDATE OPTION DATA
   
    $redirect_url = add_query_arg( 
        array( 'page' => 'ww_truanon_setting_page', 'message' => '1'), 
        admin_url('admin.php')
    );
    wp_redirect( $redirect_url );
    exit;
}