@extends('layout.app')
@section('title', 'Hoofdpagina')
@section('content')
	<header><img src="img/slide3.jpg" alt="header"></header>
	<div class="parallax-wrapper">
		<main>
			<div class="news">
				<h1 class="title">NIEUWTJES</h1>
				@forelse($articles as $article)
					<article class="front-page" id="<?= $article->id; ?>">
						<a href="nieuws#<?= $article->id ?>">
							<h2><?= $article->title ?></h2>
							<p><?= $article->body ?></p>
							<div class="footer"><?= $article->created ?></div>
						</a>
					</article>
				@empty
					<p class="text-center">Er is momenteel geen nieuws.</p>
				@endif
			</div>
		</main>
	</div>
@stop