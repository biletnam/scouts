@extends('layout.leiding')
@section('title', $user->member()->firstname.' '.$user->member()->name)
@section('content')
	<main>
		<h2>{{ $user->member()->firstname.' '.$user->member()->name }}</h2>
		<h3>Gegevens</h3>
		<form action="{{ route('gebruikers.update', [$user]) }}" method="POST" class="edit">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<ul>
				<li>
					<label>Gebruikersnaam</label>
					<input type="email" name="username" value="<?= (!empty($user->username)) ? $user->username : '' ?>">
				</li>
				<li>
					<input type="checkbox" name="active" value="1" id="active" <?= (isset($user) && $user->active) ? 'checked' : '' ?>>
					<label for="active">Actieve leiding</label>
				</li>
					<li>
					<label>Kapoenen -of welpennaam</label>
					<input type="text" name="nickname" value="<?= (!empty($user->nickname)) ? $user->nickname : '' ?>">
				</li>
					<li>
					<input type="checkbox" name="show_nick" id="show_nick" value="1" <?= (isset($user) && $user->show_nick) ? 'checked' : '' ?>>
					<label for="show_nick">Kapoenen -of welpennaam tonen</label>
				</li>
				<li>
					<label>Tak</label>
					<select name="tak_id">
						<option value="0">- Selecteer een tak -</option>
						@foreach ($takken as $tak)
							<option value="{{ $tak->id }}" {{ ($user->tak_id == $tak->id) ? 'selected' : '' }}>
								{{ $tak->name }}
							</option>
						@endforeach
					</select>
				</li>
				<li><button type="submit" class="btn-submit">Opslaan</button><a class="cancel" href="leiding/gebruikers">Annuleer</a></li>
			</ul>
		</form>
		<h3>Functies</h3>
		@if (!empty($user->roles))
			<ul id="roles">
				@foreach ($user->roles as $role)
					<li><?= ucfirst($role->name) ?> <a href="leiding/gebruikers/schrap-functie/<?= $role->lr_id ?>" class="delete-role"><i class="fa fa-trash"></i></a></li>
				@endforeach
			</ul>
			<input type="hidden" name="type" value="$CI->db->select('*')->from('roles')->where('name', $role)->row();">
		@else
			<p class="empty">Deze leider heeft momenteel geen actieve rollen</p>
		@endif
		<a href="" class="add-role"><i class="fa fa-plus"></i> functie toevoegen</a>
		<form id="add-role" action="leiding/gebruikers/add-role" method="POST">
			<select name="role_id">
				<option value="0">- Selecteer een functie -</option>
				@foreach ($roles as $role)
					<option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
				@endforeach
			</select>
			<input type="hidden" name="leader_id" value="{{ $user->id }}">
			<button type="submit">Functie toevoegen</button>
		</form>
	</main>
@stop