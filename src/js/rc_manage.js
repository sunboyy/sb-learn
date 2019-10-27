$('.groupmenu').click(function() {
	var groupid = $(this).attr('group');
	$('.lessongroup[group='+groupid+']').toggle('fast');
});
$('.lessonlist').click(function() {
	var lessonid = $(this).attr('lesson');
	window.open(currenthome+'recallcard/manage.php?lesson='+lessonid, '_self');
});
$('#gothis').click(function() {
	var lessonid = $(this).attr('lesson');
	window.open('../recallcard/recallcard_lesson.php?lesson='+lessonid, '_self');
});
$('.editcard').click(function() {
	var cardid = $(this).attr('card');
	var cardpri = $(this).attr('pri');
	var cardsec = $(this).attr('sec');
	$('#cardid_show').text(cardid);
	$('#edit_pri').val(cardpri);
	$('#edit_sec').val(cardsec);
	$('#edit_id').val(cardid);
	$('#edit_pri').attr('placeholder', cardpri);
	$('#edit_sec').attr('placeholder', cardsec);
	$('#darkoutside').fadeIn('fast');
	$('#editcardform').show();
	$('#editnameform').hide();
	$('#edit_pri').focus();
});
$('#editname').click(function() {
	var lessonname = $(this).attr('lesson');
	$('#edit_name').val(lessonname);
	$('#darkoutside').fadeIn('fast');
	$('#editcardform').hide();
	$('#editnameform').show();
	$('#edit_name').focus();
});
$('#btnAdd').click(function() {
	addcard();
});
$('#add_pri').keypress(function(e) {
	key = e.which;
	if (key == 13) {
		addcard();
	}
});
$('#add_sec').keypress(function(e) {
	key = e.which;
	if (key == 13) {
		addcard();
	}
});
function addcard() {
	var cardpri = $('#add_pri').val();
	var cardsec = $('#add_sec').val();
	if ($.trim(cardpri) == '') {
		$('#add_pri').addClass('redbox');
	}
	else {
		$('#add_pri').removeClass('redbox');
	}
	if ($.trim(cardsec) == '') {
		$('#add_sec').addClass('redbox');
	}
	else {
		$('#add_sec').removeClass('redbox');
	}
	if (($.trim(cardpri) != '') && ($.trim(cardsec) != '')) {
		$('#addcardform').submit();
	}
}
$('#btnEditCard').click(function() {
	var cardpri = $('#edit_pri').val();
	var cardsec = $('#edit_sec').val();
	if ($.trim(cardpri) == '') {
		$('#edit_pri').addClass('redbox');
	}
	else {
		$('#edit_pri').removeClass('redbox');
	}
	if ($.trim(cardsec) == '') {
		$('#edit_sec').addClass('redbox');
	}
	else {
		$('#edit_sec').removeClass('redbox');
	}
	if (($.trim(cardpri) != '') && ($.trim(cardsec) != '')) {
		$('#editcardform').submit();
	}
});
$('#btnEditName').click(function() {
	$('#editcardform').hide();
	$('#editnameform').show();
	var name = $('#edit_name').val();
	if ($.trim(name) == '') {
		$('#edit_name').addClass('redbox');
	}
	else {
		$('#edit_name').removeClass('redbox');
		$('#editnameform').submit();
	}
});
$('.canceledit').click(function() {
	$('#darkoutside').fadeOut('fast');
});
$('.delcard').click(function() {
	var cardid = $(this).attr('card');
	if (confirm('คุณแน่ใจหรือไม่ที่จะลบ '+cardid)) {
		window.open('../php/rc_deletecard.php?card='+cardid, '_self');
	}
});
