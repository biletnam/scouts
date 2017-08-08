@extends('layout.leiding')
@section('title', $member->firstname.' '.$member->name.' bewerken')
@section('content')
<div class="row">
	<main>
		<h3>Wijzig lid: {{ $member->firstname.' '.$member->name }}</h3>
		<form id="edit" action="{{ route('ledenlijst.update', [$member]) }}" method="POST" class="edit">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<h4>Persoonsgegevens</h4>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-input">
							<input type="text" name="firstname" value="{{ $member->firstname }}" placeholder="Voornaam">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-input">
							<input type="text" name="name" value="{{ $member->name }}" placeholder="Achtername">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-input">
							<input type="text" name="birthdate" value="{{ $member->birthdate }}" placeholder="Geboortedatum (DD/MM/JJJJ)">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-input">
							<input type="text" name="address" value="{{ $member->address }}" placeholder="Adres">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-input">
							<input type="text" name="zip" value="{{ $member->zip }}" placeholder="Postcode">
						</div>
					</div>
					<div class="col-sm-9">
						<div class="form-input">
							<input type="text" name="city" value="{{ $member->city }}" placeholder="Plaats">
						</div>
					</div>
				</div>
			</div>
			<h4>Contactgegevens</h4>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-input">
							<input id="tel" type="text" name="tel" value="{{ $member->tel }}" placeholder="Telefoon">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-input">
							<input id="gsm" type="text" name="gsm" value="{{ $member->gsm }}" placeholder="GSM-nummer">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-input">
							<input id="email" type="email" name="email" value="{{ $member->email }}" placeholder="E-mailadres">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<h5>Tak</h5>
						<select id="tak_id" name="tak_id">
							@foreach ($takken as $tak)
								<option value="{{ $tak->id }}" {{ ($member->tak_id == $tak->id) ? 'selected' : '' }}>{{ $tak->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				@if ($member->tak->name == 'Jins')
					<input type="hidden" name="year" value="1">
				@else
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								@if ($member->tak->name == '' || $member->tak->name == 'Leiding')
									<h5>Jaar</h5>
									<input id="year" type="number" name="year" value="{{ $member->year or 1 }}">
								@else
									<h5>Jaar</h5>
									<select id="year" name="year">
										<option value="1" {{ ($member->year == 1) ? 'selected' : '' }}>1ejaars</option>
										<option value="2" {{ ($member->year == 2) ? 'selected' : '' }}>2ejaars</option>
										@if ($member->tak->name != 'Kapoenen')
											<option value="3" {{ ($member->year == 3) ? 'selected' : '' }}>3ejaars</option>
										@endif
									</select>
								@endif
							</div>
						</div>
					</div>
				@endif
				<div class="row">
					<div class="col-sm-6">
						<div class="form-input">
							<div class="row">
								<div class="col-sm-6">
									<label class="checkbox-label" for="betaald">
										<input type="checkbox" name="paid" value="1" {{ ($member->paid) ? 'checked' : '' }}> Betaald
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<h4>Contactpersonen</h4>
		<table>
			<thead>
				<tr>
					<th>Naam</th>
					<th>Tel.</th>
					<th>GSM</th>
					<th>E-mail</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($member->contacts as $contact)
					<tr>
						<td>{{ $contact->name }}</td>
						<td>{{ $contact->tel }}</td>
						<td>{{ $contact->gsm }}</td>
						<td>{{ $contact->email }}</td>
						<td><a href="{{ route('contact.edit', [$contact]) }}" class="edit"><i class="fa fa-pencil"></i></a></td>
						<td>
							<form action="{{ route('contact.destroy', [$contact]) }}" class="delete" method="POST">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<button type="submit">
									<i class="fa fa-trash"></i>
								</button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<a href="{{ route('contact.create', [$member]) }}" class=""><i class="fa fa-plus"></i> nieuwe contactpersoon</a>
		<div class="form-group">
			<div class="form-submit">
				<button type="submit" name="submit" class="btn-submit" form="edit">Opslaan</button>
				<a class="cancel" href="leiding/ledenlijst">Annuleer</a>
			</div>
		</div>
	</main>
</div>
@stop