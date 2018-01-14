$('.groupmenu').click(function() {
	var groupid = $(this).attr('group');
	window.open(currenthome+'recallcard/recallcard_group.php?group='+groupid, '_self');
});
$('#managethis').click(function() {
	var lessonid = $(this).attr('lesson');
	window.open('../recallcard/manage.php?lesson='+lessonid, '_self');
});
$('.lessonlist').click(function() {
	var lessonid = $(this).attr('lesson');
	var page = $(this).attr('page');
	if (page == 'lesson') {
		window.open(currenthome+'recallcard/recallcard_lesson.php?lesson='+lessonid, '_self');
	}
	else if (page == 'manage') {
		window.open(currenthome+'recallcard/manage.php?lesson='+lessonid, '_self');
	}
});
