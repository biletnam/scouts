let test = false;
$(function () {
	$('#test').change(function () {
		test = $(this).val() === 'test';
		$('#test-emails').toggle();
	});

	$('button.btn-submit').click(function (e) {
		if (test) {
			e.preventDefault();
			$form = $(this).closest('form');
			$('#body').val(body.getData());
			$.post('api/mailinglists/test', $form.serialize(), function (response) {
				console.log(response);
			});
		}
	});

	$('#test-emails .add-email').click(function (e) {
		e.preventDefault();
		$('#test-emails .inputs')
			.append('<div class="form-input"><input name="emails[]" type="email"><a class="delete" href="#">' +
				'<i class="fa fa-trash text-right"></i></a></div>')
			.appendTo('.inputs');
	});

	$('body').on('click', '.inputs .delete', function (e) {
		e.preventDefault();
		$(this).closest('.form-input').remove();
	});

	$('.delete button[type=submit]').click(function (e) {
		e.preventDefault();
		$el = $(this);
		swal({
			title: 'Ben je zeker?',
			text: 'Ben je zeker dat je deze wil verwijderen?',
			icon: 'warning',
			buttons: ['Nee', 'Ja']
		}).then((willDelete) => {
			$form = $el.closest('.delete');
			if (willDelete) {
				$.post($form.attr('action'), $form.serialize(), function (response) {
					$el.closest('tr').remove();
				});
			}
		});
	});

	$('#add-email').click(function (e) {
		e.preventDefault();
		$el = $(this);
		swal({
			title: 'Welk e-mailadres wil je toevoegen?',
			content: 'input',
			icon: 'warning',
			buttons: ['Nee', 'Ja']
		}).then((value) => {
			if (value != null) {
				$('#add-email-form input[name="email"]').val(value);
				$('#add-email-form').submit();
			}
		});
	});
});