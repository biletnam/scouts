@extends('layout.leiding')
@section('title', 'Nieuwe mail opstellen')
@section('content')
	<main>
		<form class="edit" action="{{ route('mailinglijst.send-campaign') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<div class="form-label">
					<label for="subject">Onderwerp</label>
				</div>
				<div class="form-input">
					<input id="subject" type="text" name="subject">
				</div>
			</div>
			<div class="form-group">
				<div class="form-label">
					<label for="body">Inhoud</label>
				</div>
				<div class="form-input">
					<textarea id="body" name="body"></textarea>
				</div>
			</div>
			@if (isset($lists))
			<div class="form-group">
				<div class="form-label">
					<label for="list">Lijst</label>
				</div>
				<div class="form-group">
					<select name="list" id="list">
						@foreach($lists as $list)
							<option value="{{ $list['id'] }}">{{ $list['name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			@else
				<input type="hidden" name="list" value="{{ $list }}">
			@endif
			<div class="form-group">
				<div class="form-input">
					<label for="test" class="form-label">
						<input id="test" name="test" type="checkbox" value="test">
						Test-modus
					</label>
				</div>
			</div>
			<div class="form-group" id="test-emails" style="display: none;">
				<div class="inputs">
					<div class="form-label">
						<label>Test-adressen</label>
					</div>
					<div class="form-input">
						<input type="email" name="emails[]">
					</div>
				</div>
				<a href="#" class="add-email">Testadres toevoegen</a>
			</div>
			<div class="form-group">
				<div class="form-input">
					<button class="btn-submit" type="submit">Verzenden</button>
				</div>
			</div>
		</form>
	</main>
@stop
@section('js')
	<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
	<script>
		let body = CKEDITOR.replace('body');
	</script>
	<script>
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
			})

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
		})
	</script>
@stop