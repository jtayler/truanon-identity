/* START : Media Library Popup open */
jQuery( document ).ready( function( $ ) {

	// Uploading files
	var file_frame;
	var wp_media_post_id = "";	
	var set_to_post_id = '';
	var hiddenid = "";
	var imagepreview = "";

	jQuery('.tru-anon-upload-image').on('click', function( event ){
		hiddenid = $(this).data('hiddenid');
		imagepreview = $(this).data('imagepreview');
		
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			// Set the post ID to what we want
			file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
			// Open frame
			file_frame.open();
			return;
		} else {
			// Set the wp.media post id so the uploader grabs the ID we want when initialised
			wp.media.model.settings.post.id = set_to_post_id;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select a image to upload',
			button: {
				text: 'Use this image',
			},
			multiple: false	// Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			$( '#'+imagepreview ).attr( 'src', attachment.url ).css( 'width', 'auto' );
			$( '#'+hiddenid ).val( attachment.id );
						// Restore the main post ID
			wp.media.model.settings.post.id = wp_media_post_id;
		});

		// Finally, open the modal
		file_frame.open();
	});
	
	// Restore the main ID when the add media button is pressed
	jQuery( 'a.add_media' ).on( 'click', function() {
		wp.media.model.settings.post.id = wp_media_post_id;
	});
});

/* START : Hide Show Badge1_1 Section */
function hideShowBadge1_1_div(){
	var badge1_type = jQuery('input[name="ww_truanon_option[badge1_1_type]"]:checked').val();
	if(badge1_type == "Custom Image"){
		jQuery("#badge1_1_custom_image").show();
		jQuery("#badge1_1_font_awesome").hide();
	}else{
		jQuery("#badge1_1_custom_image").hide();
		jQuery("#badge1_1_font_awesome").show();
	}
}
/* START : Hide Show Badge1_1 Section */

/* START : Hide Show Badge1_2 Section */
function hideShowBadge1_2_div(){
	var badge1_type = jQuery('input[name="ww_truanon_option[badge1_2_type]"]:checked').val();
	if(badge1_type == "Custom Image"){
		jQuery("#badge1_2_custom_image").show();
		jQuery("#badge1_2_font_awesome").hide();
	}else{
		jQuery("#badge1_2_custom_image").hide();
		jQuery("#badge1_2_font_awesome").show();
	}
}
/* START : Hide Show Badge1_2 Section */

/* START : Hide Show Badge2 Section */
function hideShowBadge2div(){
	var badge2_type = jQuery('input[name="ww_truanon_option[badge2_type]"]:checked').val();
	if(badge2_type == "Custom Image"){
		jQuery("#badge2_custom_image").show();
		jQuery("#badge2_font_awesome").hide();
	}else{
		jQuery("#badge2_custom_image").hide();
		jQuery("#badge2_font_awesome").show();
	}

}
/* START : Hide Show Badge2 Section */
/* START : Hide Show Not Confirm Section */
function hideShowNotConfirmdiv(){
	var not_confirm_type = jQuery('input[name="ww_truanon_option[not_verify_type]"]:checked').val();
	if(not_confirm_type == "Custom Image"){
		jQuery("#not_verify_custom_image").show();
		jQuery("#not_verify_font_awesome").hide();
	}else{
		jQuery("#not_verify_custom_image").hide();
		jQuery("#not_verify_font_awesome").show();
	}

}
/* START : Hide Show Not Confirm Section */
/* START : Hide Show Live and Sandbox Section */
function hideShowAuthicateData(){
	var not_confirm_type = jQuery('input[name="ww_truanon_option[truanon_mode_type]"]:checked').val();
	if(not_confirm_type == "Live"){
		jQuery("#live_private_key_heading_lbl").show();
		jQuery("#live_service_id_heading_lbl").show();
		jQuery("#sendbox_private_key_heading_lbl").hide();
		jQuery("#sendbox_service_id_heading_lbl").hide();
	}else{
		jQuery("#live_private_key_heading_lbl").hide();
		jQuery("#live_service_id_heading_lbl").hide();
		jQuery("#sendbox_private_key_heading_lbl").show();
		jQuery("#sendbox_service_id_heading_lbl").show();
	}
}
/* END : Hide Show Live and Sandbox Section  */

