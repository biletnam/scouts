@extends('layout.leiding')
@section('title', 'Instellingen')
@section('content')
	<main>
		<h3>Instellingen</h3>
		<form class="edit" action="{{ route('users.save-settings') }}" method="POST">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-6">
					<div class="form-element">
						<div class="form-label">
							<label for="old_password">Oud wachtwoord</label>
						</div>
						<div class="form-input">
							<input type="password" name="old_password" placeholder="********">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-element">
							<div class="form-label">
								<label for="password">Nieuw wachtwoord</label>
							</div>
							<div class="form-input">
								<input type="password" name="password" placeholder="********">
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-element">
							<div class="form-label">
								<label for="password">Nieuw wachtwoord bevestigen</label>
							</div>
							<div class="form-input">
								<input type="password" name="password_confirmation" placeholder="********">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<button type="submit" class="btn btn-submit">Opslaan</button>
				</div>
			</div>
		</form>
	</main>
@stop
@section('js')

@stop