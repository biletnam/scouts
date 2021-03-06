@extends('layout.app')
@section('title', 'Schakeltjes - Archief')
@section('content')
	<header><img src="img/slide3.jpg" alt="header"></header>
	<div class="parallax-wrapper">
		<main>
			<h1 class="title">SCHAKELTJESARCHIEF</h1>
			@foreach($schakeltjes as $folder => $schakeltjes)
				@if (!$schakeltjes->isEmpty())
					<h2>{{ $folder }}</h2>
					<table id="schakel">
						<tbody>
							@forelse ($schakeltjes as $schakeltje)
								<tr>
									<td class="schakeltje">
										<a href="{{ $schakeltje->url }}" target="_blank">{{ $schakeltje->title }}</a>
									</td>
									<td>
										<form action="{{ route('schakeltje.destroy', $schakeltje) }}" method="POST" class="pull-right clear-right delete">
											{{ csrf_field() }}
											{{ method_field('delete') }}
											<button type="submit"><i class="fa fa-trash"></i></button>
										</form>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="2" class="text-center">Er zijn momenteel geen garchiveerde schakeltjes.</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				@endif
			@endforeach
			<br><br>
			<a href="{{ route('schakeltje.index') }}"><i class="fa fa-chevron-left"></i> Terug naar het overzicht</a>
		</main>
	</div>
@stop