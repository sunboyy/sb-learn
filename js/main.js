var currenthome = 'http://www.mrsunboy.com/edu/';
$(window).load(function() {
	$('#loading').hide('fast');
	$('#all').fadeIn('fast');
});
$('#menu').click(function() {
	if ($('#hidsidebar').css('display') == 'none') {
		$('#hidsidebar').fadeIn('fast');
	}
	else if ($('#hidsidebar').css('display') == 'block') {
		$('#hidsidebar').fadeOut('fast');
	}
});
$('.home').click(function() {
	window.open(currenthome+'index.php', '_self');
});
$('.logout').click(function() {
	window.open(currenthome+'logout.php', '_self');
});
$('.profile').click(function() {
	var from = document.URL;
	window.open(currenthome+'profile.php?from='+from, '_self');
});
$('.recallcard').click(function() {
	window.open(currenthome+'recallcard/recallcard.php', '_self');
});
$('.back').click(function() {
	window.open(currenthome+'recallcard/recallcard.php', '_self');
});
$('.add').click(function() {
	window.open(currenthome+'recallcard/recallcard_add.php', '_self');
});
$('.manage').click(function() {
	window.open(currenthome+'recallcard/manage.php', '_self');
});
$('.info').click(function() {
	window.open(currenthome+'recallcard/info.php', '_self');
});
$('#main').click(function() {
	if ($('#hidsidebar').css('display') == 'block') {
		$('#hidsidebar').fadeOut('fast');
	}
});
$('.latest').click(function() {
	var lessonid = $(this).attr('lesson');
	window.open(currenthome+'recallcard/recallcard_lesson.php?lesson='+lessonid, '_self');
});
$('.groupicon').click(function() {
	var groupid = $(this).attr('group');
	window.open(currenthome+'recallcard/recallcard_group.php?group='+groupid, '_self');
});
