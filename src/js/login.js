$(window).load(function () {
	$('#darkoutside').fadeIn('fast');
	$('#loading').hide('fast');
	$('#all').fadeIn('fast');
});

$('#loginform').submit(function (e) {
	e.preventDefault();
	$('#btnLogin').prop('disabled', true);
	$.post('php/login.php', { pwd: $('#pwd').val() }, function (data) {
		$('#btnLogin').prop('disabled', false);
		if (data.error) {
			$('#errorMsg').show();
			$('#errorMsg').text(data.msg);
		} else {
			location.reload();
		}
	});
});
