@extends('layout.leiding')
@section('title', 'Nieuwsberichten')
@section('content')
	<main>
		<h3>Wijzig "{{ $article->title }}"</h3>
		<form action="{{ route('nieuws.update', [$article]) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<ul class="nieuws-edit">
				<li>
					<input type="text" name="title" class="edit-title" placeholder="Titel" value="{{ $article->title }}">
				</li>
				<li>
					<textarea name="body" class="edit-body" cols="30" rows="10">{{ $article->body }}</textarea></li>
				<li>
					<button type="submit" class="btn-submit">Opslaan</button>
					<a class="cancel" href="{{ route('nieuws.index') }}">Annuleer</a>
				</li>
			</ul>
		</form>
		<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
		<script type="text/javascript">CKEDITOR.replace('body');</script>
	</main>
@stop