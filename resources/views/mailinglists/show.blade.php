@extends('layout.leiding')
@section('title', 'Maillijst '.$list['name'])
@section('content')
	<main>
		<h1>{{ $list['name'] }}</h1>
		<p>
			<a id="add-email" class="btn btn-submit" href="#">
				<i class="fa fa-plus"></i> e-mailadres toevoegen
			</a>
			<a class="btn btn-gray" href="{{ route('mailinglijst.new-campaign-for-list', [strtolower($list['name'])]) }}">
				<i class="fa fa-send"></i> nieuwe mail verzenden
			</a>
		</p>
		<form id="add-email-form" action="{{ route('mailinglijst.add-subscriber', [strtolower($list['name'])]) }}" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="email">
		</form>
		@if(count($list['members']) > 0)
			<table class="table table-striped">
				<thead>
				<tr>
					<td>E-mailadres</td>
					<td>Unsubscribe</td>
				</tr>
				</thead>
				<tbody>
				@foreach($list['members'] as $member)
					@if ($member['status'] !== 'unsubscribed')
						<tr>
							<td>{{ $member['email_address'] }}</td>
							<td>
								<form class="delete" action="{{ route('mailinglijst.remove-subscriber', strtolower($list['name'])) }}"
								      method="POST">
									{{ method_field('delete') }}
									{{ csrf_field() }}
									<input type="hidden" name="email" value="{{ $member['email_address'] }}">
									<button type="submit">
										<i class="fa fa-trash"></i>
									</button>
								</form>
							</td>
						</tr>
					@endif
				@endforeach
				</tbody>
			</table>
		@else
			<p>Deze lijst is leeg</p>
		@endif
	</main>
@stop

@section('js')
	<script>
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
		})

		$('#add-email').click(function (e) {
			e.preventDefault();
			$el = $(this);
			swal({
				title: 'Welk e-mailadres wil je toevoegen?',
				content: 'input',
				icon: 'warning',
				buttons: ['Nee', 'Ja']
			}).then((value) => {
				$('#add-email-form input[name="email"]').val(value);
				$('#add-email-form').submit();
			});
		});
	</script>
@stop