<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page
 *
 * Handle settings
 * 
 * @package TruAnon Identity
 * @since 1.1
 */
 

global $ww_truanon_verification_model;
$all_options = get_option( TRUANON_VERIFICATION_OPTION );

if(isset($_POST['reset-badge1_1-upload-image'])){
    $all_options['badge1_1_upload_image'] = '';
    $ww_truanon_verification_model->update_all_option_data( $all_options );
}
if(isset($_POST['reset-badge1_2-upload-image'])){
    $all_options['badge1_2_upload_image'] = '';
    $ww_truanon_verification_model->update_all_option_data( $all_options );
}
if(isset($_POST['reset-badge2-upload-image'])){
    $all_options['badge2_upload_image'] = '';
    $ww_truanon_verification_model->update_all_option_data( $all_options );
}
if(isset($_POST['reset-not-verify-upload-image'])){
    $all_options['not_verify_upload_image'] = '';
    $ww_truanon_verification_model->update_all_option_data( $all_options );
}
if(!isset($_POST['reset-badge1_1-upload-image']) && !isset($_POST['reset-badge1_2-upload-image']) &&
!isset($_POST['reset-badge2-upload-image']) &&  !isset($_POST['reset-not-verify-upload-image'])){
    $ww_truanon_verification_model->update_all_option_data( $all_options );
}
if(isset($_POST['reset_setting'])){
    update_option( TRUANON_VERIFICATION_OPTION,'' );
    update_option( 'truanon_db_version','' );
    truanon_verification_register_activation();
}


$model = $ww_truanon_verification_model;
/* START : FETCH SETTINGS DATA */
$truanon_setting_data = $model->get_all_option_data();

$truanon_mode_type = isset( $truanon_setting_data['truanon_mode_type'] ) ? $truanon_setting_data['truanon_mode_type'] : esc_html__( 'Sendbox', 'truanon-identity' );
$private_key = isset( $truanon_setting_data['private_key'] ) ? $truanon_setting_data['private_key'] : "";
$service_id = isset( $truanon_setting_data['service_id'] ) ? $truanon_setting_data['service_id'] : "";
$live_private_key = isset( $truanon_setting_data['live_private_key'] ) ? $truanon_setting_data['live_private_key'] : "";
$live_service_id = isset( $truanon_setting_data['live_service_id']) ? $truanon_setting_data['live_service_id'] : "";
$verify_text = isset( $truanon_setting_data['verify_text'] ) ? $truanon_setting_data['verify_text'] : "";
$badge1_1_type = isset( $truanon_setting_data['badge1_1_type'] ) ? $truanon_setting_data['badge1_1_type'] : "Custom Image";
$badge1_2_type = isset( $truanon_setting_data['badge1_2_type'] ) ? $truanon_setting_data['badge1_2_type'] : "Custom Image";
$badge1_1_upload_image = !empty( $truanon_setting_data['badge1_1_upload_image'] ) ? $truanon_setting_data['badge1_1_upload_image'] : "";
$badge1_2_upload_image = !empty( $truanon_setting_data['badge1_2_upload_image'] ) ? $truanon_setting_data['badge1_2_upload_image'] : "";
$badge1_1_upload_image_url = !empty( $truanon_setting_data['badge1_1_upload_image'] ) ? esc_url( wp_get_attachment_url($truanon_setting_data['badge1_1_upload_image']) ) : esc_url( TRUANON_VERIFICATION_URL.'includes/images/KnownHigh.png' );
$badge1_2_upload_image_url = !empty( $truanon_setting_data['badge1_2_upload_image'] ) ? esc_url( wp_get_attachment_url($truanon_setting_data['badge1_2_upload_image']) ) : esc_url( TRUANON_VERIFICATION_URL.'includes/images/KnownLow.png' );
$badge1_1_font_awesome = !empty( $truanon_setting_data['badge1_1_font_awesome'] ) ? $truanon_setting_data['badge1_1_font_awesome'] : esc_html__( "far fa-check-circle", 'truanon-identity' ) ;
$badge1_2_font_awesome = !empty( $truanon_setting_data['badge1_2_font_awesome'] ) ? $truanon_setting_data['badge1_2_font_awesome'] : esc_html__( "far fa-check-circle", 'truanon-identity' ) ;


$badge1_description = !empty( $truanon_setting_data['badge1_description'] ) ? stripslashes_deep( $truanon_setting_data['badge1_description']) : "";

 
$badge2_type = isset( $truanon_setting_data['badge2_type'] ) ? $truanon_setting_data['badge2_type'] : "Custom Image";
$badge2_font_awesome = !empty( $truanon_setting_data['badge2_font_awesome'] ) ? $truanon_setting_data['badge2_font_awesome'] : esc_html__( "far fa-check-circle", 'truanon-identity' );
$badge2_upload_image = !empty( $truanon_setting_data['badge2_upload_image'] ) ? $truanon_setting_data['badge2_upload_image'] : '';
$badge2_upload_image_url = !empty( $truanon_setting_data['badge2_upload_image'] ) ? esc_url (wp_get_attachment_url( $truanon_setting_data['badge2_upload_image'] ) ) : esc_url ( TRUANON_VERIFICATION_URL.'includes/images/Unknown.png' );
$badge2_description = !empty( $truanon_setting_data['badge2_description'] ) ? stripslashes_deep( $truanon_setting_data['badge2_description'] ) : "";
$profile_information = isset( $truanon_setting_data['profile_information'] ) ? stripslashes_deep( $truanon_setting_data['profile_information'] ) : "" ;
$badge_less_then_score = isset( $truanon_setting_data['badge_less_then_score'] ) ? stripslashes($truanon_setting_data['badge_less_then_score']) : esc_html__( "2.5", 'truanon-identity' );
$badge_greater_then_score = isset( $truanon_setting_data['badge_greater_then_score'] ) ? stripslashes( $truanon_setting_data['badge_greater_then_score'] ) : esc_html__( "2.5", 'truanon-identity' );

$not_verify_type = isset( $truanon_setting_data['not_verify_type'] ) ? $truanon_setting_data['not_verify_type'] : esc_html__( "Custom Image" , 'truanon-identity' );
$not_verify_font_awesome = !empty( $truanon_setting_data['not_verify_font_awesome'] ) ? $truanon_setting_data['not_verify_font_awesome'] : esc_html__( "far fa-check-circle", 'truanon-identity' );
$not_verify_upload_image = !empty( $truanon_setting_data['not_verify_upload_image'] ) ? $truanon_setting_data['not_verify_upload_image'] : '';
$not_verify_upload_image_url = !empty( $truanon_setting_data['not_verify_upload_image'] ) ? esc_url( wp_get_attachment_url( $truanon_setting_data['not_verify_upload_image'] ) ) : esc_url( TRUANON_VERIFICATION_URL.'includes/images/UnknownOwner.png' );
//$not_confirm_txt  = isset( $truanon_setting_data['not_confirm_txt'] ) ? $truanon_setting_data['not_confirm_txt'] : esc_html__( "You must confirm your profile using TruAnon, click here to confirm" , 'truanon-identity' );
$not_confirm_txt  = isset( $truanon_setting_data['not_confirm_txt'] ) ? $truanon_setting_data['not_confirm_txt'] : "";
$confirm_profile = isset( $truanon_setting_data['confirm_profile'] ) ? $truanon_setting_data['confirm_profile'] : "" ;

/* END : FETCH SETTINGS DATA */
//check settings updated or not
if(isset($_GET['message']) && $_GET['message'] == '1') {
    
    echo '<div class="updated" id="message">
        <p><strong>'. esc_html__( "Changes Saved Successfully.",'truanon-identity' ) .'</strong></p>
    </div>';
}
else if (isset($_GET['message']) && $_GET['message'] == '2') {
    
    echo '<div class="updated" id="message">
        <p><strong>'. esc_html__( "Please enter valid URL",'truanon-identity' ) .'</strong></p>
    </div>';
}
if(isset($_GET['message']) && $_GET['message'] == '3') {
    
    echo '<div class="updated" id="message">
        <p><strong>'. esc_html__( "Changes Saved Successfully.",'truanon-identity' ) .'</strong></p>
    </div>';
}   

?>
<!-- . begining of wrap -->
<div class="wrap">
    <?php 
        echo "<h2>" . esc_html__( 'TruAnon Settings', 'truanon-identity' ) . "</h2>";
    ?>                  
    <!-- beginning of the plugin options form -->
    <form name="truanon_settings_form" action="" method="POST" >
        <table class="form-table sa-manage-level-product-box"> 
            <tbody>
                <tr>
                    <td colspan="2">
                    <h2><?php esc_html_e('Authentication Settings', 'truanon-identity'); ?></h2>
                </td>
                </tr>
                <?php
                    $live_custom_style =$sendbox_custom_style=""; 
                    if($truanon_mode_type == "Live"){
                        $live_custom_style="row";
                        $sendbox_custom_style="none";
                    }else{
                        $live_custom_style="none";
                        $sendbox_custom_style="row";
                    }
                ?>

                <tr id="truanon_mode_section" >
                    <th scope="row">
                        <label for="truanon_mode_lbl"><strong><?php esc_html_e('Deployment', 'truanon-identity'); ?></strong></label>
                    </th>
                    <td width="300">
                        <input type="radio" name="ww_truanon_option[truanon_mode_type]" id="tru_anon_live_mode" value="Live"  <?php echo ($truanon_mode_type == "Live")?"checked":""; ?> onclick="return hideShowAuthicateData();"/><label for="tru_anon_live_mode"><?php esc_html_e('Production', 'truanon-identity'); ?></label> &nbsp;&nbsp;
                        <input type="radio" name="ww_truanon_option[truanon_mode_type]" id="tru_anon_sendbox_mode" value="Sendbox" <?php echo ($truanon_mode_type == "Sendbox")?"checked":""; ?> onclick="return hideShowAuthicateData();"/><label for="tru_anon_sendbox_mode"><?php esc_html_e('Staging', 'truanon-identity'); ?></label>
                    </td>
                </tr>
                <tr id="live_private_key_heading_lbl" style="display:<?php echo $live_custom_style;?>" >
                    <th scope="row">
                        <label for="live_private_key"><strong><?php esc_html_e('Private Key', 'truanon-identity'); ?></strong></label>
                    </th>
                    <td width="300">
                        <input type='text' name='ww_truanon_option[live_private_key]' id='live_private_key' value='<?php echo $live_private_key;?>' maxlength="200" class="regular-text">
                    </td>
                </tr>
                <tr id="live_service_id_heading_lbl" style="display:<?php echo $live_custom_style;?>">
                    <th scope="row">
                        <label for="live_service_id"><strong><?php esc_html_e('Service ID', 'truanon-identity'); ?></strong></label>
                    </th>
                    <td width="300">
                        <input type='text' name='ww_truanon_option[live_service_id]' id='live_service_id' value='<?php echo $live_service_id;?>' maxlength="50" class="regular-text">
                    </td>
                </tr>
                    <tr id="sendbox_private_key_heading_lbl" style="display:<?php echo $sendbox_custom_style;?>">
                    <th scope="row">
                        <label for="private_key"><strong><?php esc_html_e('Private Key', 'truanon-identity'); ?></strong></label>
                    </th>
                    <td width="300">
                        <input type='text' name='ww_truanon_option[private_key]' id='private_key' value='<?php echo $private_key;?>' maxlength="200" class="regular-text">
                    </td>
                </tr>
                <tr id="sendbox_service_id_heading_lbl" style="display:<?php echo $sendbox_custom_style;?>">
                    <th scope="row">
                        <label for="service_id"><strong><?php esc_html_e('Service ID', 'truanon-identity'); ?></strong></label>
                    </th>
                    <td width="300">
                        <input type='text' name='ww_truanon_option[service_id]' id='service_id' value='<?php echo $service_id;?>' maxlength="50" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><hr><h2><?php esc_html_e('Badge Settings', 'truanon-identity'); ?></h2></td>
                </tr>               

               <tr id="badge1_description_lbl" >
                    <th scope="row">
                        <label for="badge1_description_id"><strong><?php esc_html_e( 'Known User Text', 'truanon-identity' ); ?></strong></label>
                    </th>
                    <td width="300">
                        <?php 

                            $settings = array(
                                        'textarea_name' => 'ww_truanon_option[badge1_description]',
                                        'textarea_rows'=> '10', 
                                        'tinymce' => true, 
                                        'media_buttons' => false,
                                        'wpautop' => true,
                                    );
                            wp_editor( html_entity_decode($badge1_description), 'badge1_description', $settings );

                        ?> 
                        <br /><span class="description"><?php esc_html_e( 'This badge information will be displayed once a user has confirmed their profile. The following shortcodes are supported:', 'truanon-identity' ); ?></span><br />             
                        </td>
                </tr>
                    
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <code><?php esc_html_e( '{profile_name}', 'truanon-identity' ); ?></code> - <?php esc_html_e( 'TruAnon Username', 'truanon-identity' ); ?> <br />
                        <code><?php esc_html_e( '{profile_title}', 'truanon-identity' ); ?></code> -<?php esc_html_e( 'User Title', 'truanon-identity' ); ?> <br />
                        <code><?php esc_html_e( '{rank_title}', 'truanon-identity' ); ?></code> - <?php esc_html_e( 'User Rank Title', 'truanon-identity' ); ?> <br />
                        <code><?php esc_html_e( '{rank_score}', 'truanon-identity' ); ?></code> - <?php esc_html_e( 'User Rank Score', 'truanon-identity' ); ?> <br />
                        <code><?php esc_html_e( '{profile_url}', 'truanon-identity' ); ?></code> - <?php esc_html_e( 'Public Profile URL', 'truanon-identity' ); ?><br />
                    </td>

                </tr>

                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr id="badge2_description_lbl" >
                    <th scope="row">
                        <label for="badge2_description_id"><strong><?php esc_html_e( 'Unknown User Text', 'truanon-identity' ); ?></strong></label>
                    </th>
                    <td width="300">
                        <?php 

                            $settings = array(
                                        'textarea_name' => 'ww_truanon_option[badge2_description]',
                                        'textarea_rows'=> '10', 
                                        'tinymce' => true, 
                                        'media_buttons' => false,
                                        'wpautop' => true,
                                        );
                            wp_editor( html_entity_decode($badge2_description), 'ww_truanon_option_badge2_description', $settings );
                        ?>              
                        <br /><span class="description"><?php esc_html_e( 'This badge information will be displayed for those who have not confirmed.', 'truanon-identity' ); ?></span><br />
                        </td>
                </tr>

                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr id="not_verify_text_lbl" >
                    <th scope="row">
                        <label for="not_verify_text_id"><strong><?php esc_html_e( 'Unknown/Owner Text', 'truanon-identity' ); ?></strong></label>
                    </th>
                    <td width="300">
                        <?php 

                            $settings = array(
                                        'textarea_name' => 'ww_truanon_option[not_confirm_txt]',
                                        'textarea_rows'=> '10', 
                                        'tinymce' => true, 
                                        'media_buttons' => false,
                                        'wpautop' => true,
                                    );
                            wp_editor( html_entity_decode($not_confirm_txt), 'not_confirm_txt', $settings );

                        ?> 
                        <br /><span class="description"><?php esc_html_e('This badge information will be displayed to the badge owner when they have not yet confirmed. The following shortcode is for the confirmation link.', 'truanon-identity'); ?></span><br />             
                        </td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>
                        <code><?php esc_html_e( '{confirm_url}', 'truanon-identity' ); ?></code> - <?php esc_html_e( 'TruAnon Confirm URL link. It will display like "Click here to confirm".', 'truanon-identity' ); ?><br />
                    </td>
                </tr>
            
                <tr>
                    <td colspan="2"><hr/>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" class="form-control button-primary" name="tru_anon_setting" value="<?php esc_html_e( 'Save', 'truanon-identity' ); ?>" id="tru_anon_setting" >
                         <input type="submit" class="form-control " name="reset_setting" value="<?php esc_html_e( 'Reset Full Setting', 'truanon-identity' ); ?>" id="tru_anon_setting" >
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field( 'truanon_save_options', 'truanon_save_options_field' ); ?>
    </form>
</div><!-- .end of wrap -->