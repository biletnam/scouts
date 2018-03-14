@extends('layout.leiding')
@section('title', 'Print ledenlijst')
@section('content')
	<main class="leden">
		<h2>Ledenlijst</h2>
		<h3>{{ $tak->name }}</h3>
		<style type="text/css">
			input[type='checkbox']:not(:first-child) { margin-left: 15px;}
			input[type='checkbox'] { margin-right: 5px;}
		</style>
		<form id="checks" action="{{ route('ledenlijst.print', [strtolower(str_replace('\'', '', $tak->name))]) }}" method="POST">
			{{ csrf_field() }}
			<input id="birthdate" type="checkbox" name="birthdate" value="birthdate" {{ (in_array('birthdate', $args)) ? 'checked' : '' }}>
			<label for="birthdate">Geboortedatum</label>
			<input id="address" type="checkbox" name="address" value="address" {{ (in_array('address', $args)) ? 'checked' : '' }}>
			<label for="address">Adres</label>
			<input id="gsm" type="checkbox" name="gsm" value="gsm" {{ (in_array('gsm', $args)) ? 'checked' : '' }}>
			<label for="gsm">GSM-nummer</label>
			<input id="tel" type="checkbox" name="tel" value="tel" {{ (in_array('tel', $args)) ? 'checked' : '' }}>
			<label for="tel">Telefoonnummer</label>
			<input id="email" type="checkbox" name="email" value="email" {{ (in_array('email', $args)) ? 'checked' : '' }}>
			<label for="email">E-mailadres</label>
			<input id="year" type="checkbox" name="year" value="year" {{ (in_array('year', $args)) ? 'checked' : '' }}>
			<label for="year">Jaar</label>
			<br>
			<a id="printLink" href=""><span class="glyphicon glyphicon-print"></span> Printen</a>
		</form>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Voornaam</th>
					<th>Achternaam</th>
					@if (in_array('birthdate', $args))
						<th>Geboortedatum</th>
					@endif
					@if (in_array('address', $args))
						<th>Adres</th>
					@endif
					@if (in_array('gsm', $args))
						<th>GSM</th>
					@endif
					@if (in_array('tel', $args))
						<th>Telefoon</th>
					@endif
					@if (in_array('email', $args))
						<th>E-mailadres</th>
					@endif
					@if (in_array('year', $args))
						<th>Jaar</th>
					@endif
					<th>Aanwezig</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tak->members()->orderBy('year')->orderBy('firstname')->get() as $member)
					<tr>
						<td>{{ $member->firstname }}</td>
						<td>{{ $member->name }}</td>
						@if (in_array('birthdate', $args))
							<td>{{ $member->birthdate }}</td>
						@endif
						@if (in_array('address', $args))
							<td>{{ $member->address }}<br>{{ $member->zip }} {{ $member->city }}</td>
						@endif
						@if (in_array('gsm', $args))
							<td>
								@foreach($member->contacts as $contact)
									{{ $contact->gsm }}<br>
								@endforeach
								{{ $member->gsm }}
							</td>
						@endif
						@if (in_array('tel', $args))
							<td>
								@foreach($member->contacts as $contact)
									{{ $contact->tel }}<br>
								@endforeach
								{{ $member->tel }}
							</td>
						@endif
						@if (in_array('email', $args))
							<td>
								@foreach($member->contacts as $contact)
									{{ $contact->email }}<br>
								@endforeach
								{{ $member->email }}
							</td>
						@endif
						@if (in_array('year', $args))
							<td>{{ $member->year }}ejaars</td>
						@endif
						<td style="border-left: 2px solid #ddd; border-right: 2px solid #ddd;"></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</main>
@stop
@section('js')
	<script type="text/javascript" src="js/members.js" nonce="{{ $scriptNonce }}"></script>
@stop