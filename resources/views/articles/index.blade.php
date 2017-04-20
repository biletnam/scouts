@extends((Auth::check()) ? 'layout.leiding' : 'layout.app')
@section('title', 'Nieuwsberichten')
@section('content')
	<div class="parallax-wrapper">
		<main id="news">
			<h2 class="{{ (Auth::guest()) ? 'title' : '' }}">NIEUWSOVERZICHT</h2>
			@if (Auth::check())
				<div><a href="{{ route('nieuws.create') }}"><i class="fa fa-plus"></i> maak een nieuw bericht aan</a></div>
			@endif
			<div class="news">
				@forelse($articles as $article)
					<article class="clear-left" id="{{ $article->id }}">
						<h3 class="pull-left">{{ $article->title }}</h3>
						@if (Auth::check())
							@if(Auth::user()->hasPermission('nieuws'))
								<div class="controls">
									<form action="{{ route('nieuws.destroy', [$article]) }}" class="delete" method="POST">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit">
											<i class="fa fa-trash"></i>
										</button>
									</form>
									<a href="{{ route('nieuws.edit', [$article]) }}"><i class="fa fa-pencil"></i></a>
								</div>
							@endif
						@endif
						<div class="clear-left">{!! $article->body !!}</div>
						<div class="footer">{{ $article->created_at }}</div>
					</article>
				@empty
					<p>Er is momenteel geen nieuws.</p>
				@endforelse
			</div>
		</main>
	</div>
@stop