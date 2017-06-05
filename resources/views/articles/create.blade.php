@extends('layout.leiding')
@section('title', 'Nieuwsberichten')
@section('content')
	<main>
		<h3>Voeg een artikel toe</h3>
		<form action="{{ route('nieuws.store') }}" method="post">
			{{ csrf_field() }}
			<ul class="nieuws-edit">
				<li>
					<input type="text" name="title" class="edit-title" placeholder="Titel" value="{{ old('title') }}">
				</li>
				<li>
					<textarea name="body" class="edit-body" cols="30" rows="10">{{ old('body') }}</textarea></li>
				<li>
					<button type="submit" class="btn-submit">Opslaan</button>
					<a class="cancel" href="{{ route('nieuws.index') }}">Annuleer</a>
				</li>
			</ul>
		</form>
	</main>
@stop
@section('js')
	<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
	<script type="text/javascript">CKEDITOR.replace('body');</script>
@stop