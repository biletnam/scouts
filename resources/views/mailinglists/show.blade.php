@extends('layout.leiding')
@section('title', 'Maillijst '.$list['name'])
@section('content')
	<main>
		<h1>{{ $list['name'] }}</h1>
		<p>
			<a class="btn btn-submit" href="{{ route('mailinglijst.new-campaign-for-list', [$list['id']]) }}">
				<i class="fa fa-plus"></i> e-mailadres toevoegen
			</a>
			<a class="btn btn-gray" href="{{ route('mailinglijst.new-campaign-for-list', [$list['id']]) }}">
				<i class="fa fa-send"></i> nieuwe mail verzenden
			</a>
		</p>
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
							<td><i class="fa fa-trash"></i></td>
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