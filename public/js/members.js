var selected = 0;
$(function() {
	$("button.copy").click(function(e) {
		e.preventDefault();
		var $emails = $(this).siblings('.email-list').find('.addresses');
		var $temp = $('<input>');

		$(this).siblings('.email-list').slideToggle();
		$("body").append($temp);
		$temp.val($emails.val()).select();
		document.execCommand("copy");
		$temp.remove();
		/*$('copy-confirm').fadeIn('slow');
		setTimeout(
			$('copy-confirm').fadeOut('slow');
		);*/
	});
	$('.paid i').click(function() {
		$el = $(this);
		$.get('leiding/ledenlijst/toggle_paid/'+ $(this).data('id'), function(result) {
			$el.toggleClass('fa-check');
			$el.toggleClass('fa-remove');
		});
	});

	$('.select').change(function() {
		console.log('check');
		console.log($('.select:checked').length);
		selected = $('.select:checked').length;
		if (selected > 0) { $('#action').prop('disabled', false); }
		else { $('#action').prop('disabled', true) }
	});
	$('#action').change(function() {
		if (selected > 0) { this.form.submit(); }
		console.log('submit');
	});
});