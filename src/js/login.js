$(document).ready(function() {
	var width = $(window).width(), height = $(window).height();
	$('#darkoutside').css('width', width);
	$('#darkoutside').css('height', height);
	$('#topbar').css('width', width-50);
	$('#sidebar').css('height', height-50);
	$('#hidsidebar').css('height', height-50);
	$('#main').css('width', width-50);
	$('#main').css('height', height-50);
	$('#wide').css('width', width-200);
	$('#center').css('left', ((width / 2) - 200)+'px');
	$('#center').css('top', ((height / 2) - 100)+'px');
});
$(window).load(function() {
	$('#darkoutside').fadeIn('fast');
	$('#loading').hide('fast');
	$('#all').fadeIn('fast');
});
