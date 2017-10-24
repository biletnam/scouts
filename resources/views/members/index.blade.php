@extends('layout.leiding')
@section('title', 'Ledenlijst')
@section('content')
	<main class="leden">
		@include('partial.success')
		<p class="pull-right"><a href="leiding/ledenlijst/excelify"><img src="img/excel.gif" alt="Excelify"></a></p>
		<h2>Ledenoverzicht</h2>
		@foreach ($members as $index => $tak)
			<div>
				<h3>{{ ($index !== 'jojos') ? ucfirst($index) : 'Jojo\'s' }}: {{ count($tak) }}</h3>
				<a class="pull-right print" href="{{ route('ledenlijst.print', [$index]) }}"><i class="fa fa-print"></i>Print ledenlijst</a>

				@if (Auth::user()->hasPermission('administratie'))
					<a href="{{ route('ledenlijst.create', [$index]) }}" class="add"><i class="fa fa-plus"></i> Nieuw lid</a>
				@endif

				<button class="btn-gray copy {{ $index }}">E-mailadressen kopiëren</button>
				<div class="email-list" id="{{ $index }}">
					<b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
					@php
						$email = '';
						foreach ($tak as $member) {
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

				<div class="table-leden">
					<table class="table table-striped leden">
						<thead>
						<tr>
							<th>Voornaam</th>
							<th>Achternaam</th>
							<th>GSM</th>
							<th>Jaar</th>
							<th>E-mailadres</th>
							@if (Auth::user()->hasPermission('administratie'))
								<th class="betaald">Betaald</th>
							@endif
						</tr>
						</thead>
						<tbody>
						@if (count($tak) > 0)
							@foreach ($tak as $member)
								<tr>
									<td>{{ $member->firstname }}</td>
									<td>{{ $member->name }}</td>
									<td>
										<a href="tel:{{ empty($member->gsm) && !empty($member->contacts()->first()) ? $member->contacts()->first()->formatMobile() : $member->formatMobile() }}"
											class="btn btn-primary">
											<i class="fa fa-phone"></i> Bellen
										</a>
									</td>
									<td class="text-center">{{ $member->year }}</td>
									<td>
										{!! $member->getEmails() !!}
									</td>
									@if (Auth::user()->hasPermission('administratie'))
										<td class="paid">
											<i class="fa {{ ($member->paid) ? 'fa-check' : 'fa-remove' }}" data-id="{{ $member->id }}"></i>
										</td>
									@endif
									<td><a href="{{ route('ledenlijst.show', [$member]) }}"><i class="fa fa-eye"></i></a></td>
									@if (Auth::user()->hasPermission('administratie'))
										<td><a href="{{ route('ledenlijst.edit', [$member]) }}"><i class="fa fa-pencil"></i></a></td>
										<td>
											<form action="{{ route('ledenlijst.destroy', ['member' => $member]) }}" class="delete" method="POST">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
												<button type="submit">
													<i class="fa fa-trash"></i>
												</button>
											</form>
										</td>
									@endif
								</tr>
							@endforeach
						@else
							<tr><td colspan="6">Er zijn geen leden in deze tak</td></tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>
		@endforeach
	<!-- <div class="copy-confirm">Gekopieerd!</div> -->
	</main>
@stop
@section('js')
	<script src="js/members.js"></script>
@stop