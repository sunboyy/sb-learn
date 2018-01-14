var currenthome = 'http://localhost/edu/';
function resize() {
	var width = $(window).width(), height = $(window).height();
	$('#sidebar').css('height', height-50);
	$('#popup_right').css('height', height-50);
}
$(document).ready(function() {
	resize();
});
$(window).resize(function() {
	resize();
});
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
$('.close').click(function() {
	if (confirm('คุณต้องการปิดหน้าต่างหรือไม่?')) {
		window.close();
	}
});
$('#main').click(function() {
	if ($('#hidsidebar').css('display') == 'block') {
		$('#hidsidebar').fadeOut('fast');
	}
});
$('#buttonhide').click(function() {
	$('.seccol').hide();
	$('#buttonshow').removeClass('highlight');
	$('#buttonhide').addClass('highlight');
});
$('#buttonshow').click(function() {
	$('.seccol').show();
	$('#buttonshow').addClass('highlight');
	$('#buttonhide').removeClass('highlight');
});
$('.table').click(function() {
	if (thislist == 'lesson') {
		window.open('wordlist.php?type=lesson&lesson='+listid, '_self');
	}
	else if (thislist == 'group') {
		window.open('wordlist.php?type=group&group='+listid, '_self');
	}
	else if (thislist == 'selected') {
		window.open('wordlist.php?type=selected&group='+listid+'&selected='+selectedcode, '_self');
	}
});
$('.cards').click(function() {
	if (thislist == 'lesson') {
		window.open('cardlist.php?type=lesson&lesson='+listid, '_self');
	}
	else if (thislist == 'group') {
		window.open('cardlist.php?type=group&group='+listid, '_self');
	}
	else if (thislist == 'selected') {
		window.open('cardlist.php?type=selected&group='+listid+'&selected='+selectedcode, '_self');
	}
});
$('.random').click(function() {
	if (thislist == 'lesson') {
		window.open('randomcard.php?type=lesson&lesson='+listid, '_self');
	}
	else if (thislist == 'group') {
		window.open('randomcard.php?type=group&group='+listid, '_self');
	}
	else if (thislist == 'selected') {
		window.open('randomcard.php?type=selected&group='+listid+'&selected='+selectedcode, '_self');
	}
});
$('.abox').click(function() {
	if ($(this).attr('show') == "true") {
		$(this).attr('show', 'false');
		numopen--;
		$('#numopening').text(numopen);
		var sec = $(this).attr('sec');
		$(this).html(sec);
	}
	else if ($(this).attr('show') == "false") {
		$(this).attr('show', 'true');
		numopen++;
		$('#numopening').text(numopen);
		$(this).html('&nbsp;');
	}
	$(this).toggleClass('dark');
	if (numopen >= 2) {
		$('#btnGoSelect').removeAttr('disabled');
	}
	else {
		$('#btnGoSelect').attr('disabled', 'disabled');
	}
});
$('#ahideall').click(function() {
	$('.abox').attr('show', 'true');
	$('.abox').addClass('dark');
	numopen = totalcard;
	$('#numopening').text(numopen);
	$('.abox').html('&nbsp;');
	if (numopen >= 2) {
		$('#btnGoSelect').removeAttr('disabled');
	}
});
$('#ashowall').click(function() {
	$('.abox').attr('show', 'false');
	$('.abox').removeClass('dark');
	numopen = 0;
	$('#numopening').text(numopen);
	$('.abox').each(function() {
		var sec = $(this).attr('sec');
		$(this).html(sec);
	});
	$('#btnGoSelect').attr('disabled', 'disabled');
});
$(document).keypress(function(e) {
	key = e.which;
	if ($('#continuous').css('display') == 'block') {
		if ((key == 113) || (key == 81)) {
			//q
			$('#random_left').show('fast');
			rand();
		}
		if ((key == 97) || (key == 65)) {
			//a
			ans();
		}
	}
	else if ($('#continuous').css('display') == 'none') {
		if (key == 13) {
			if ($('#asol').css('display') == 'block') {
				next();
			}
			else {
				checkanswer();
			}
		}
	}
});
$('#random').click(function() {
	rand();
});
$('#answer').click(function() {
	ans();
});
$('#continuous_title').click(function() {
	$('#continuous').show('fast');
	$('#getpoint').hide('fast');
	$('#atext').show('fast');
	$('#abox').hide('fast');
	$('#asol').hide('fast');
	$('#point').val('0');
	$('#point').removeClass('redbox');
});
$('#getpoint_title').click(function() {
	rand();
	$('#random_left').show('fast');
	$('#continuous').hide('fast');
	$('#getpoint').show('fast');
	$('#atext').hide('fast');
	$('#abox').show('fast');
	$('#asol').hide('fast');
	$('#textbox_ans').focus();
});
$('#btnChk').click(function() {
	checkanswer();
});
$(document).keypress(function(e) {
	var key = e.which;
});
function checkanswer() {
	var answer = $('#textbox_ans').val();
	if (answer == currentcard.secondary) {
		var pointold = $('#point').val();
		var pointnew = pointold - (-1);
		$('#point').val(pointnew);
		$('#point').removeClass('redbox');
	}
	else {
		var pointold = $('#point').val();
		var pointnew = pointold - 4;
		$('#point').val(pointnew);
		$('#point').addClass('redbox');
	}
	$('#textbox_ans').val('');
	$('#abox').hide('fast');
	$('#asol').show('fast');
}
$('#btnNext').click(function() {
	next();
});
function next() {
	$('#abox').show('fast');
	$('#asol').hide();
	rand();
	$('#textbox_ans').focus();
}
$('.checkbox').click(function(e) {
	state = $(this).attr('state');
	if (state == 'no') {
		if (e.shiftKey) {
			if (lastselected != '0000') {
				var str2 = $(this).attr('numcardnow');
				var thisclick = pad.substring(0, pad.length - str2.length) + str2;
				if (thisclick > lastselected) {
					var first = lastselected, last = thisclick;
				}
				else {
					var first = thisclick, last = lastselected;
				}
				$('.checkbox').each(function() {
					var str3 = $(this).attr('numcardnow');
					var checknum = pad.substring(0, pad.length - str3.length) + str3;
					if ((checknum >= first) && (checknum <= last)) {
						if ($(this).attr('state') == 'no') {
							$(this).attr('src', '../images/theme/'+theme+'/checked.png');
							$(this).attr('state', 'yes');
							numcheck++;
						}
					}
				});
			}
		}
		else {
			$(this).attr('src', '../images/theme/'+theme+'/checked.png');
			$(this).attr('state', 'yes');
			numcheck++;
		}
		if (numcheck == totalcard) {
			$('.checkall').attr('src', '../images/theme/'+theme+'/checked.png');
			$('.checkall').attr('state', 'yes');
		}
		var str = $(this).attr('numcardnow');
		lastselected = pad.substring(0, pad.length - str.length) + str;
	}
	else if (state == 'yes') {
		$(this).attr('src', '../images/theme/'+theme+'/unchecked.png');
		$(this).attr('state', 'no');
		numcheck--;
		$('.checkall').attr('src', '../images/theme/'+theme+'/unchecked.png');
		$('.checkall').attr('state', 'no');
		lastselected = '0000';
	}
	$('#showcheckp').show('fast');
	$('#showcheck').text(numcheck);
	if (numcheck >= 2) {
		$('#btnGoSelect').removeAttr('disabled');
	}
	else {
		$('#btnGoSelect').attr('disabled', 'disabled');
	}
});
$('.checkall').click(function() {
	state = $(this).attr('state');
	if (state == 'no') {
		$('.checkbox').attr('src', '../images/theme/'+theme+'/checked.png');
		$('.checkbox').attr('state', 'yes');
		$(this).attr('src', '../images/theme/'+theme+'/checked.png');
		$(this).attr('state', 'yes');
		numcheck = totalcard;
	}
	else if (state == 'yes') {
		$('.checkbox').attr('src', '../images/theme/'+theme+'/unchecked.png');
		$('.checkbox').attr('state', 'no');
		$(this).attr('src', '../images/theme/'+theme+'/unchecked.png');
		$(this).attr('state', 'no');
		numcheck = 0;
	}
	$('#showcheckp').show('fast');
	$('#showcheck').text(numcheck);
	if (numcheck >= 2) {
		$('#btnGoSelect').removeAttr('disabled');
	}
	else {
		$('#btnGoSelect').attr('disabled', 'disabled');
	}
});
$('#btnGoSelect').click(function() {
	var cardlist = "";
	$('.checkbox').each(function() {
		if ($(this).attr('state') == 'yes') {
			if (cardlist == "") {
				cardlist = cardlist+($(this).attr('cardid'));
			}
			else {
				cardlist = cardlist+'A'+($(this).attr('cardid'));
			}
		}
	});
	$('.dark').each(function() {
		if (cardlist == "") {
			cardlist = cardlist+($(this).attr('cardid'));
		}
		else {
			cardlist = cardlist+'A'+($(this).attr('cardid'));
		}
	});
	window.open('wordlist.php?type=selected&group='+groupid+'&selected='+cardlist, '_self');
});
