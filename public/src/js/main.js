
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
	
	interActivePost();

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

	//attach images
	$('.att-btn').click(function(){
		$(this).parent().parent().trigger('click');
	});
	
});

//click on body
$(document).ready(function(){
	$('body').click(function(){
		$('.post-menu-act').hide();
	});
});

