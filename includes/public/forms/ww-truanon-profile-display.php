<?php
$truanon_setting_data = $this->model->get_all_option_data();

$verify_text = isset($truanon_setting_data['verify_text']) ? $truanon_setting_data['verify_text'] : "";
$profile_information = isset($truanon_setting_data['profile_information']) ? $truanon_setting_data['profile_information'] : "";


$not_verify_text = isset($truanon_setting_data['not_verify_text']) ? $truanon_setting_data['not_verify_text'] : esc_html__("Not Confirm", 'truanon-identity');
$badge1_description = !empty($truanon_setting_data['badge1_description']) ? stripslashes_deep($truanon_setting_data['badge1_description']) : "";
$badge2_description = !empty($truanon_setting_data['badge2_description']) ? stripslashes_deep($truanon_setting_data['badge2_description']) : "";
//$not_confirm_txt  = isset( $truanon_setting_data['not_confirm_txt'] ) ? stripslashes_deep( $truanon_setting_data['not_confirm_txt'] ): esc_html__( "You must confirm your profile using TruAnon, click here to confirm", 'truanon-identity' );

$not_confirm_txt = isset($truanon_setting_data['not_confirm_txt']) ? stripslashes_deep($truanon_setting_data['not_confirm_txt']) : "";


$trunanon_user_id = !empty($trunanon_user_id) ? $trunanon_user_id : "";
$trunanon_user_name = !empty($trunanon_user_name) ? $trunanon_user_name : "";
$truanon_profile_id = !empty($trunanon_user_id) ? $trunanon_user_id : get_current_user_id(); //get_userdata
$user_data = get_userdata($truanon_profile_id);
$verify_status = "";
$user_profile_link = "#";

$verify_result = $this->model->truanon_get_profile($trunanon_user_name);

if (!empty($verify_result) && $verify_result['response']['code'] == '200' && $verify_result['response']['message'] == 'OK') {
  // API SUCCESS PART 
  $user_data = json_decode($verify_result['body']);

  if ($user_data->type != "error") {

    // Get user profile data
    $dataConfigurations = !empty($user_data->dataConfigurations) ? $user_data->dataConfigurations : array();
    if (!empty($dataConfigurations)) {
      foreach ($dataConfigurations as $key_configurations => $val_configurations) {
        if ($val_configurations->dataPointType == "truanon") {
          $user_profile_link = $val_configurations->displayValue;
        }
      }
    }
    $profile_image = $user_data->authorPhoto;
    $tru_user_name = $user_data->authorFullName;
    $tru_rank_score = $user_data->authorRankScore;
    $tru_user_title = $user_data->authorTitle;
    $tru_rank = $user_data->authorRank;

    $verify_status = esc_html__("Confirm", 'truanon-identity');
    $badgePatterns = array('{profile_name}', '{profile_title}', '{rank_score}', '{profile_url}', '{rank_title}');

    $badgeReplacements = array($tru_user_name, $tru_user_title, $tru_rank_score, $user_profile_link, $tru_rank);
  }
}

echo '&nbsp;';
// Check verify status display the content accordingly
if ($verify_status == "Confirm") {
  if ($tru_rank_score < $badge_less_then_score) {
    $tru_anon_cls = "bg-custom-yellow";
  }
  else {
    $tru_anon_cls = "bg-custom-blue";
  }

  $textClasses = array(
      'genuine' => 'primary'
      , 'reliable' => 'success'
      , 'credible' => 'secondary'
      , 'cautioned' => 'warning'
      , 'dangerous' => 'danger'
  );
  $textClass = $textClasses[strtolower($tru_rank)];

  echo str_replace('{rank_color}', $textClass, str_replace($badgePatterns, $badgeReplacements, $badge1_description));
}
else { // If profile is not verified
  if ($trunanon_user_id == get_current_user_id() && is_user_logged_in()) {

    $click_here_text = "";
    if ($trunanon_user_id == get_current_user_id() || (is_user_logged_in() && $trunanon_user_id == "")) {
      $not_confirm_txt = str_replace('{confirm_url}', do_shortcode('[truanon_verify_profile username=' . $trunanon_user_name . ']'), $not_confirm_txt);
    }

    echo $not_confirm_txt;
  }
  else {
    echo str_replace($badgePatterns, $badgeReplacements, $badge2_description);
  }
}
?>

<!-- Not Confirm POPUP Code -->
<div class="user-verify-popup" style="display:none;" id="user-verify-section">
  <div class="user-verify-popup-body">
    <div class="user-verify-popup-body-content">            
    </div>
  </div>
</div>
