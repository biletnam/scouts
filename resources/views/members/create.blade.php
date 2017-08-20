@extends('layout.leiding')
@section('title', 'Lid toevoegen')
@section('content')
	<div class="row">
		<main>
			@include('partial.errors')
			@include('partial.success')
			<h3>Voeg een lid toe bij {{ $tak->name }}</h3>
			<form action="{{ route('ledenlijst.store') }}" method="POST" class="edit">
				{{ csrf_field() }}
				<h4>Persoonsgegevens</h4>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-input">
								<input id="firstname" type="text" name="firstname" value="{{ old('firstname') }}" placeholder="Voornaam">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-input">
								<input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Achternaam">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-input">
								<input id="birthdate" type="text" name="birthdate" value="{{ old('birthdate') }}" placeholder="Geboortedatum (DD/MM/JJJJ)">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								<input id="address" type="text" name="address" value="{{ old('address') }}" placeholder="Adres">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-input">
								<input id="zip" type="text" name="zip" value="{{ old('zip') }}" placeholder="Postcode">
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-input">
								<input id="city" type="text" name="city" value="{{ old('city') }}" placeholder="Plaats">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="hidden" name="tak_id" value="{{ $tak->id }}">
					@if ($tak->name == 'Jins')
						<input type="hidden" name="year" value="1">
					@else
						<div class="row">
							<div class="col-sm-12">
								<div class="form-input">
									@if ($tak->name == '' || $tak->name == 'Leiding'))
										<input id="year" type="number" name="year" value="{{ old('year') or 1 }}">
									@else
										<select id="year" name="year">
											<option value="1" {{ (old('year') == 1) ? 'selected' : '' }}>1ejaars</option>
											<option value="2" {{ (old('year') == 2) ? 'selected' : '' }}>2ejaars</option>
											@if ($tak->name != 'Kapoenen')
												<option value="3" {{ (old('year') == 3) ? 'selected' : '' }}>3ejaars</option>
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
										<label class="checkbox-label"><input type="checkbox" name="paid" value="1" {{ (old('paid'))? 'checked' : '' }}> Betaald</label>
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
							<label class="radio-label"><input type="radio" name="own_contact" value="1"> Eigen gegevens</label><br>
							<label class="radio-label"><input type="radio" name="own_contact" value="0" checked> Gegevens voogd</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								<input type="text" name="contact[name]" value="{{ old('contact[name]') }}" placeholder="Naam contact">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-input">
								<input type="text" name="contact[tel]" value="{{ old('contact[tel]') }}" placeholder="Telefoonnummer">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-input">
								<input type="text" name="contact[gsm]" value="{{ old('contact[gsm]') }}" placeholder="GSM-nummer">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-input">
								<input type="email" name="contact[email]" value="{{ old('contact[email]') }}" placeholder="E-mailadres">
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
@section('js')
	<script src="js/members.js"></script>
@stop