
"use strict";

jQuery( document ).ready(function($) {
   
   $(document).on( 'click', '.verify-btn', function(e) {
      e.preventDefault();
		var url   =  $(this).attr('data-url');
		var left  = ($(window).width()/2)-(480/2);
		var top   = ($(window).height()/2)-(830/2);
		console.log(url);
		window.open(url, "ta-popup", "width=480, height=830, top="+top+", left="+left);
		  var win = window.open('','ta-popup');
        var timer = setInterval(function () {
            if (win.closed) {
                clearInterval(timer);
                window.location.reload(); //refresh on close
            }
        }, 1000);
   });
        
   $(document).on( 'click', '.user-section', function(e) {

	  if($('.profile-section-show').length > 0 && !$(this).hasClass('user-section-show')){
		   $('.user-section').removeClass('user-section-show');   
		   $(".profile-section-main").removeClass('profile-section-show'); 
	  }	 	  
      $(this).next(".profile-section-main").toggleClass('profile-section-show');
      $(this).toggleClass('user-section-show');   
   });
      
   $(document).on( 'click', '.not-verified-img', function(e) {
		$(this).parent(".non-confirm-img-div").next(".profile-not-verified-section-main").toggleClass('profile-section-show');
		$(this).parent(".non-confirm-img-div").toggleClass('user-section-show');
		
		$('.confirm-user').removeClass('user-section-show');   
		$(".confirm-profile").removeClass('profile-section-show'); 
	   
	   
/* 	  if($('.profile-section-show').length > 0 ){
		   $('.user-section').removeClass('user-section-show');   
		   $(".profile-section-main").removeClass('profile-section-show');  
	  } 
	 console.log($(this).parent(".non-confirm-img-div").hasClass('user-section-show'));
	  console.log($(this).parent(".non-confirm-img-div").next(".profile-not-verified-section-main").hasClass('profile-section-show'));
	  
	  if($(this).parent(".non-confirm-img-div").next(".profile-not-verified-section-main").hasClass('profile-section-show') ){
			//&& $(this).parent(".non-confirm-img-div").next(".profile-not-verified-section-main").hasClass('profile-section-show')
			console.log('remove');
		   $(".non-confirm-img-div").removeClass('user-section-show');   
		   $(".profile-not-verified-section-main").removeClass('profile-section-show'); 
	  }else{
		   console.log('open');
		  $(this).parent(".non-confirm-img-div").next(".profile-not-verified-section-main").toggleClass('profile-section-show');
		  $(this).parent(".non-confirm-img-div").toggleClass('user-section-show');
	  }  */
   });
});