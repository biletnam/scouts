<form id="login" action="login" method="POST">
	{{ csrf_field() }}
	<ul>
		<li>
			<label for="username">Gebruikersnaam:</label>
			@if (isset($errors) && $errors->any() && $errors->has('username'))
				<span class="help-block">
				<strong>{{ $errors->first('username') }}</strong>
			</span>
			@endif
		</li>
		<li><input id="username" type="text" name="username" placeholder="iemand@18bp.be"></li>
		<li>
			<label for="password">Wachtwoord:</label>
			@if (isset($errors) && $errors->any() && $errors->has('password'))
				<span class="help-block">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif
		</li>
		<li><input id="password" type="password" name="password" placeholder="**************"></li>
		<li><button class="btn-submit" type="submit">Aanmelden</button></li>
	</ul>
</form>