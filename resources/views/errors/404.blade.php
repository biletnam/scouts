@extends('layout.app')
@section('title', 'Pagina niet gevonden')
@section('content')
	<main>
		<h1 class="title">404 - Pagina niet gevonden</h1>
		<p>
			De pagina die je probeert te bereiken kon niet worden gevonden. Kijk de link na en probeer opnieuw of keer terug naar de
			<a href="{{ url('/') }}">hoofdpagina</a>
		</p>
	</main>
@stop