
$( document ).ready(function(){
	//side nav based on screen
	$(".button-collapse").sideNav();
	//auto resize of textarea
	$('#new-post').trigger('autoresize');
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

	//show menu edit/delete post
	$('.popup-post-menu').click(function(e){
		$(this).next().show();
		e.stopPropagation();
	});

	//position of account avatar
	if($('.cover-img img').height() < 350){
		$('.account-avatar').css({'left' : ($(window).width()/2 - 30).toString() + 'px', 'top' : $('.cover-img img').height().toString() + 'px'});
	}else{
		$('.account-avatar').css({'left' : ($(window).width()/2 - 30).toString() + 'px', 'top' : '350px'});
	}

	
});

//click on body
$(document).ready(function(){
	$('body').click(function(){
		$('.post-menu-act').hide();
	});
});