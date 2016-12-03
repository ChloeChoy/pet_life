
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
	//material media box
	$('.materialboxed').materialbox();
	
	
	interActivePost();
	triggerUploadImg();
	changeUploadName();
	tabUserInfo();
	triggerUserForm();

	//magnific popup (view image gallery)
	$('#user-photos-gallery').magnificPopup({
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

	$('#user-videos-gallery').magnificPopup({
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
		$('.main-search').fadeIn(100);
	});

	//hide main search
	$('.close-main-search').click(function(){
		$('.main-nav').fadeIn(100);
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
		var id = $(this).parent().parent().attr('data-postid');
		addthis.update('share', 'url', '//localhost/pet_life/public/post/' + id); 
		addthis.url = "//localhost/pet_life/public/post/" + id;                
		addthis.toolbox(".addthis_inline_share_toolbox");
		$('#pl-share-post').show().css({'position' : 'absolute', 'top': ($(this).position().top + 20).toString() + 'px', 'left' : ($(this).position().left).toString() + 'px'});
		e.stopPropagation();
	});

	//show manage users link in admin page
	$('.manage-user-btn').click(function(e){
		$('#manage-users').show();
		e.stopPropagation();
	});

	//upload avatar/cover photo
	$('#form-upload-photos').submit(function(){
		$('#modal-upload-images').hide();
	});

	//redirect to comment post
	$('.comment-post').click(function(){
		var id = $(this).parent().parent().attr('data-postid');
		$(this).attr('href', 'post/' + id);
	});

	//show input url
	$('.embedded-video').click(function(){
		$('.input-url').show();
		$('#emb-video').focus();
	});
	
});

//click on body
$(document).ready(function(){
	$('body').click(function(){
		$('.post-menu-act').hide();
		$('#pl-share-post').hide();
		$('#manage-users').hide();
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

//function select gender
function selectGender(){
	$('label[for="male"]').click(function(){
		$('#male').attr('checked', 'true');
		$('#female').removeAttr('checked');
	});
	$('label[for="female"]').click(function(){
		$('#male').removeAttr('checked');
		$('#female').attr('checked', 'true');
	});
}
selectGender();