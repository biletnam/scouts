// All dem JS's
$(function(){

	$('.takken:not(:first-child)').hide();
	$('.photobox').hide();

	//DEN18 Fold
	$('.subnav .blocklink a').click(function(e) {
		e.preventDefault();
		
		var tak = $(this).data('href');
		if($('.takken#' + tak).css('display') != 'block') {
			$('.takken').slideUp('slow');
			$('#' + tak).slideDown('slow');
		}
	});

	//DEN18 FOTO'S

	$('.overlay, .pasfoto>img').click(function() {
		var img = $($(this).siblings('img')).attr('src');
		$('.photobox img').attr('src', img);
		$('.name-overlay').text($($(this).siblings('img')).attr('alt'));
		$('.photobox').stop(true, true).fadeIn('fast');
		$('.shadow').show();
	});

	$('.shadow').click(function() {close_photobox();});

	$(document).keydown(function(e) {
		if (e.which == 27) {
			close_photobox();
		}
	});

	$('#close-button').click(function () { close_photobox();});
});

function close_photobox() {
	$('.photobox').stop(true, true).fadeOut('fast');
	$('.shadow').hide();
}