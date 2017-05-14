@extends('layout.leiding')
@section('title', 'Contact bewerken')
@section('content')
<div class="row">
	<main>
		<h3>{{ $contact->name.' bewerken' }}</h3>
		<form id="edit" action="{{ route('contact.update', [$contact]) }}" method="POST" class="edit">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<div class="form-group">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-input">
							<input id="name" type="text" name="name" value="{{ $contact->name }}" placeholder="Naam contactpersoon">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-input">
							<input id="tel" type="text" name="tel" value="{{ $contact->tel }}" placeholder="Telefoon">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-input">
							<input id="gsm" type="text" name="gsm" value="{{ $contact->gsm }}" placeholder="GSM-nummer">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-input">
							<input id="email" type="email" name="email" value="{{ $contact->email }}" placeholder="E-mailadres">
						</div>
					</div>
				</div>
			</div>
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