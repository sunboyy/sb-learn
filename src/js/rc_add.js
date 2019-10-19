$('.grouplist').click(function() {
	var groupid = $(this).attr('groupid'), groupname = $(this).text();
	$('#showgroupname').html(groupname);
	$('#lsngroup').attr('value', groupid);
	$('.grouplist').removeClass('highlight');
	$(this).addClass('highlight');
});
$('#btnAdd').click(function() {
	var name = $('#lsnname').val(),groupid = $('#lsngroup').attr('value');
	if (groupid == '') {
		$('#showgroupname').addClass('red');
	}
	else {
		$('#showgroupname').removeClass('red');
	}
	if ($.trim(name) == '') {
		$('#lsnname').addClass('redbox');
	}
	else {
		$('#lsnname').removeClass('redbox');
	}
	if (($.trim(name) != '') && (groupid != '')) {
		$('#form_addlesson').submit();
	}
});
