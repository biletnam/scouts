@extends('layout.leiding')
@section('title', $kid->firstname.' '.$kid->name.' wijzigen')
@section('content')
	<div class="row">
		<main>
			@include('partial.errors')
			@include('partial.success')
			<h3>Wijzig {{ $kid->firstname.' '.$kid->name }}</h3>
			<form action="{{ route('wachtlijst.update', [$kid]) }}" method="POST" class="edit">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<h4>Persoonsgegevens</h4>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-input">
								<input id="firstname" type="text" name="firstname" value="{{ $kid->firstname or old('firstname') }}" placeholder="Voornaam">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-input">
								<input id="name" type="text" name="name" value="{{ $kid->name or old('name') }}" placeholder="Achternaam">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-input">
								<input id="birthdate" type="text" name="birthdate" value="{{ $kid->birthdate or old('birthdate') }}" placeholder="Geboortedatum (DD/MM/JJJJ)">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								<input id="address" type="text" name="address" value="{{ $kid->address or old('address') }}" placeholder="Adres">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-input">
								<input id="zip" type="text" name="zip" value="{{ $kid->zip or old('zip') }}" placeholder="Postcode">
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-input">
								<input id="city" type="text" name="city" value="{{ $kid->city or old('city') }}" placeholder="Plaats">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								<select id="year" name="year">
									<option value="1" {{ ($kid->year == 1) ? 'selected' : '' }}>1ejaars</option>
									<option value="2" {{ ($kid->year == 2) ? 'selected' : '' }}>2ejaars</option>
									@if ($kid->tak != 'Kapoenen')
										<option value="3" {{ ($kid->year == 3) ? 'selected' : '' }}>3ejaars</option>
									@endif
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								<select id="tak" name="tak">
									<option value="Kapoenen" {{ ($kid->tak == 'Kapoenen') ? 'selected' : '' }}>Kapoenen</option>
									<option value="Welpen" {{ ($kid->tak == 'Welpen') ? 'selected' : '' }}>Welpen</option>
									<option value="Jojo\'s" {{ ($kid->tak == 'Jojo\'s') ? 'selected' : 'Jojo\'s' }}>Jojo's</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-input">
								<div class="row">
									<div class="col-sm-6">
										<label class="checkbox-label"><input type="checkbox" name="priority" value="1" {{ ($kid->priority || old('priority'))? 'checked' : '' }}> Broer/zus</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<h4>Contactgegevens</h4>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-input">
								<input type="text" name="tel" value="{{ $kid->tel or old('tel') }}" placeholder="Telefoonnummer">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-input">
								<input type="text" name="gsm" value="{{ $kid->gsm or old('gsm') }}" placeholder="GSM-nummer">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								<input type="email" name="email" value="{{ $kid->email or old('email') }}" placeholder="E-mailadres">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="form-submit">
						<button type="submit" name="submit" class="btn-submit">Opslaan</button>
						<a class="cancel" href="leiding/ledenlijst">Annuleer</a>
					</div>
				</div>
				</ul>
			</form>
		</main>
	</div>
@stop