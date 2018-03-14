@extends('layout.leiding')
@section('title', 'Contact toevoegen')
@section('content')
<div class="row">
	<main>
		<h3>Nieuw contactpersoon voor: {{ $member->firstname.' '.$member->name }}</h3>
		<form id="edit" action="{{ route('contact.store') }}" method="POST" class="edit">
			{{ csrf_field() }}
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-input">
							<label class="radio-label"><input type="radio" name="existing" value="1" checked> Overnemen van bestaand lid</label><br>
							<label class="radio-label"><input type="radio" name="existing" value="0"> Nieuw contact</label>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group existing">
				<select name="member" id="member"></select>
				<div class="contacts">

				</div>
			</div>
			<div class="form-group contact-form">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-input">
							<input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Naam contactpersoon">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-input">
							<input id="tel" type="text" name="tel" value="{{ old('tel') }}" placeholder="Telefoon">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-input">
							<input id="gsm" type="text" name="gsm" value="{{ old('gsm') }}" placeholder="GSM-nummer">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-input">
							<input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-mailadres">
						</div>
					</div>
				</div>
			</div>
			<input type="hidden" name="member_id" value="{{ $member->id }}">
			<div class="form-group">
				<div class="form-submit">
					<button type="submit" name="submit" class="btn-submit" form="edit">Opslaan</button>
					<a class="cancel" href="leiding/ledenlijst">Annuleer</a>
				</div>
			</div>
		</form>
	</main>
</div>
@stop

@section('js')
	<script type="text/javascript" src="js/members.js" nonce="{{ $scriptNonce }}"></script>
@stop