//side nav based on screen
$( document ).ready(function(){
	$(".button-collapse").sideNav();
});


$(document).ready(function(){
	$('#pl-search').focus(function(){
		$('.reset-search').css({'left' : ($(this).outerWidth() - 40).toString() + 'px'}).show();
	}).blur(function(){
		$('.reset-search').hide();
	});
});
		