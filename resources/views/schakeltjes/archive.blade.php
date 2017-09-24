@extends('layout.app')
@section('title', 'Schakeltjes - Archief')
@section('content')
	<header><img src="img/slide3.jpg" alt="header"></header>
	<div class="parallax-wrapper">
		<main>
			<h1 class="title">SCHAKELTJESARCHIEF</h1>
			<ul id="schakel">
				@forelse ($schakeltjes as $schakeltje)
					<li class="schakeltje">
						<a href="{{ $schakeltje->url }}" target="_blank">{{ $schakeltje->title }}</a>
					</li>
				@empty
					<li class="text-center">Er zijn momenteel geen garchiveerde schakeltjes.</li>
				@endforelse
			</ul>
			<a href="{{ route('schakeltje.index') }}"><i class="fa fa-chevron-left"></i> Terug naar het overzicht</a>
		</main>
	</div>
@stop