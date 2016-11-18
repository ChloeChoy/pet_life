
//function show edit/delete post
function interActivePost(){
	//show menu edit/delete post
	$('.popup-post-menu').click(function(e){
		$(this).next().show();
		e.stopPropagation();
	});
}

//function edit position of submit button
function submitPosition(){
	var x = $('.post-form .field-submit');
	$('.post-form').append(x);
}

$( document ).ready(function(){
	//side nav based on screen
	$(".button-collapse").sideNav();
	//auto resize of textarea
	$('#new-post').trigger('autoresize');
	//collapse user info
	$('.collapsible').collapsible();
	//input date in user info
	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15, // Creates a dropdown of 15 years to control year
	    closeOnSelect: true
	});
	
	interActivePost();
	triggerUploadImg();
	changeUploadName();
	tabUserInfo();
	triggerUserForm();

	//preview image by dropzone
	$(".post-form").dropzone({ 
				url: "/laravel/public/src/images",
				maxFilesize: 10,
				addRemoveLinks: true,
				dictRemoveFile: 'delete',
				uploadMultiple: true,
				paramName: 'image',
				acceptedFiles: 'image/*',
				parallelUploads: 1,
				init: function() {
					this.on('success', function(file, response) {
						// If you return JSON as response (with the proper `Content-Type` header
						// it will be parsed properly. So lets say you returned:
						// `{ "fileName": "my-file-2234.jpg" }`

						// Create a hidden input to submit to the server:
					});

					this.on('queuecomplete', function() {
						// Invoked when all files finished uploading
						// Now just submit the form. It will send the filenames along since
						// they are added as hidden input fields.
						$('.dz-filename span').each(function () {
							$(".post-form").append($('<input type="hidden" ' +
							'name="files[]" ' +
							'value="' + $(this).text() + '">'));
						});
						// submitPosition();
					});
				}
				
			}); 

	//magnific popup (view image gallery)
	jQuery('#user-photos-gallery').magnificPopup({
		delegate: 'img',
	  	type: 'image',
	  	// other options
	  	gallery: {
	          enabled:true
	    },
        removalDelay: 300,

		// Class that is added to popup wrapper and background
		// make it unique to apply your CSS animations just to this exact popup
		mainClass: 'mfp-fade'
	});

	jQuery('#user-videos-gallery').magnificPopup({
		delegate: 'img',
	  	type: 'image',
	  	// other options
	  	gallery: {
	          enabled:true
	    },
        removalDelay: 300,

		// Class that is added to popup wrapper and background
		// make it unique to apply your CSS animations just to this exact popup
		mainClass: 'mfp-fade'
	});
});


$(document).ready(function(){
	//display main search box
	$('#display-main-search').click(function(){
		$('.main-nav').hide();
		$('.main-search').fadeIn(200);
	});

	//hide main search
	$('.close-main-search').click(function(){
		$('.main-nav').fadeIn();
		$('.main-search').hide();
	});

	//position of reset search button
	$('#pl-search').focus(function(){
		$('.reset-search').css({'left' : ($(this).outerWidth() - 40).toString() + 'px'}).show();
	}).blur(function(){
		$('.reset-search').hide();
	});

	//position of account avatar
	if($('.cover-img img').height() < 350){
		$('.account-avatar').css({'left' : ($(window).width()/2 - 30).toString() + 'px', 'top' : $('.cover-img img').height().toString() + 'px'});
	}else{
		$('.account-avatar').css({'left' : ($(window).width()/2 - 30).toString() + 'px', 'top' : '350px'});
	}

	//submit post
	$('.post-form').submit(function(){
		if($('#new-post').val() == '')
			return false;
	});

	//trigger attach images
	$('.att-btn').click(function(){
		$('#att-files').trigger('click');
	});

	//show share post button
	$('.share-post').click(function(e){
		$('#pl-share-post').show().css({'position' : 'absolute', 'top': ($(this).position().top + 20).toString() + 'px', 'left' : ($(this).position().left).toString() + 'px'});
		e.stopPropagation();
	});

});

//click on body
$(document).ready(function(){
	$('body').click(function(){
		$('.post-menu-act').hide();
		$('#pl-share-post').hide();
	});
});

// function trigger upload profile images
function triggerUploadImg(){
	$('.edit-wall-img').click(function(){
		$('#profile-img').trigger('click');
	});

	$('.edit-avatar').click(function(){
		$('#profile-img').trigger('click');
	});
	
	$('.change-user-photos').click(function(){
		$('#profile-img').trigger('click');
	});
}

//function change name of input type="file" in form upload profile images
function changeUploadName(){
	$('.edit-avatar').click(function(){
		$('#profile-img').attr('name', 'profile_img');
	});

	$('.edit-wall-img').click(function(){
		$('#profile-img').attr('name', 'cover_img');
	});
}


//function click tabs user info
function tabUserInfo(){
	$('.tab-link').click(function(){
		$('.tab-link').removeClass('link-active');
		$(this).addClass('link-active');
	});
}

//function trigger form edit user info
function triggerUserForm(){
	$('#place-live').click(function(){
		$('#live-info').trigger('click');
	});

	$('#workplace').click(function(){
		$('#work-info').trigger('click');
	});

	$('#user-birth').click(function(){
		$('#birthday-info').trigger('click');
	});
	$('#gender-info').click(function(){
		$('#user-gender-info').trigger('click');
	});

	$('.cancel').click(function(){
		$(this).parent().parent().prev().trigger('click');
	});
}