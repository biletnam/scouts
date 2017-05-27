@extends('layout.leiding')
@section('title', Auth::user()->member->tak->name.': Ledenlijst')
@section('content')
	@php
		$tak = (Auth::user()->member->tak->name === 'Jojo\'s') ? 'jojos' : strtolower(Auth::user()->member->tak->name);
	@endphp
	<main class="leden">
		<?php  
			// <p class="pull-right"><a href="leiding/ledenlijst/excelify"><img src="img/excel.gif" alt="Excelify"></a></p>
		?>
		<h2>Ledenoverzicht</h2>
		<div>
			<h3>{{ Auth::user()->member->tak->name }}: {{ count($members) }}</h3>
			<a class="pull-right print" href="{{ route('ledenlijst.print', [$tak]) }}">Print ledenlijst</a>

			<button class="copy {{ $tak }}">E-mailadressen kopiëren</button>
			<div class="email-list" id="{{ $tak }}">
				<b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
				@php
					$email = '';
					foreach ($members as $member) {
						if (isset($member->email) && $member->email != '') {
							if (strpos($email, $member->email) === FALSE) {
								$email.=$member->email.'; ';
							}
						} else {
							foreach ($member->contacts as $contact) {
								if (strpos($email, $contact->email) === FALSE) {
									$email.=$contact->email.'; ';
								}
							}
						}
					}
				@endphp
				{{ $email }}
				<input type="hidden" value="{{ $email }}" class="addresses">
			</div>

			<table class="table table-striped leden">
				<thead>
				<tr>
					<th>Voornaam</th>
					<th>Achternaam</th>
					<th>Geboortedatum</th>
					<th>GSM</th>
					<th>Jaar</th>
					<th>E-mailadres</th>
				</tr>
				</thead>
				<tbody>
				@if (count($members) > 0)
					@foreach ($members as $member)
						<tr>
							<td>{{ $member->firstname }}</td>
							<td>{{ $member->name }}</td>
							<td>{{ $member->birthdate }}</td>
							<td>{{ $member->gsm }}</td>
							<td class="text-center">{{ $member->year }}</td>
							<td>
								@if (isset($member->email))
									{{ str_replace(';', '<br>', $member->email) }}
								@else
									@foreach ($member->contacts as $contact)
										@if (isset($contact->email))
											{{ $contact->email }}<br>
										@endif
									@endforeach
								@endif
							</td>
							<td><a href="{{ route('ledenlijst.show', [$member]) }}"><i class="fa fa-eye"></i></a></td>
						</tr>
					@endforeach
				@else
					<tr><td colspan="6">Er zijn geen leden in deze tak</td></tr>
				@endif
				</tbody>
			</table>
		</div>
	</main>
@stop
@section('js')
	<script src="js/members.js"></script>
@stop