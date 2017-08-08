@extends('layout.app')
@section('title', 'Den 18')
@section('content')
	<header><img src="img/slide3.jpg" alt="header"></header>
	<div class="parallax-wrapper">
		<main>
			<h1 class="title">DEN 18</h1>
			<div class="subnavbar">
				<div class="subnav">
					<div class="row">
						<div class="blocklink">
							<a data-href="groep">DE GROEP</a>
						</div>
						<div class="blocklink">
							<a data-href="kapoenen">KAPOENEN</a>
						</div>
						<div class="blocklink">
							<a data-href="welpen">WELPEN</a>
						</div>
						<div class="blocklink">
							<a data-href="jojos">JOJO'S</a>
						</div>
						<div class="blocklink">
							<a data-href="givers">GIVERS</a>
						</div>
						<div class="blocklink">
							<a data-href="leiding">LEIDING</a>
						</div>
					</div>
				</div>
			</div>
			<div class="content18">
				<div class="takken" id="groep">
					<h2 class="text-center">De groep</h2>
					<p class="den18content">
						<p>
						<b>E-mailadres:</b> <a href="mailto:info@18bp.be">info@18bp.be</a><br>
						<b>Rekeningnr.:</b> BE36 0688 9980 6581
					</p>
						Den 18 is een bloeiende scoutsgroep, gevestigd in de Langstraat te Borgerhout.
						Sinds 1919 is "den 18" niet meer weg te denken uit het straatbeeld.
						<br><br>
						Aangesterkt door een geëngageerde ouderploeg zijn de 18ers niet te stuiten.
					</p>
					<h3>Meer weten over de groep?</h3>
					<p>
						Vanaf heden kan u <a href="geschiedenis">hier</a> terecht voor meer informatie over het ontstaan
						en de gebruiken van den 18BP.
					</p>
				</div>

				@foreach ($takken as $tak)
					@php
						$takleiding = $tak->takleiding();
					@endphp
					<div class="takken" id="{{ ($tak->name !== 'Jojo\'s') ? strtolower($tak->name) : 'jojos' }}">
						<h2 class="text-center">{{ $tak->name }} {{ (isset($tak->age)) ? '('.$tak->age.')' : '' }}</h2>

						<p>
							<b>E-mailadres:</b> <a href="mailto:{{ $tak->email }}">{{ $tak->email }}</a><br>
							<b>Rekeningnr.:</b> {{ $tak->account }}
						</p>
						<h3>Activiteiten:</h3>
						<p>{!! $tak->description !!}</p>

						<h3>Leiding</h3>
						<table>
							<thead>
								<th>Naam</th>
								<th>Adres</th>
								<th>E-mail</th>
								<th>GSM</th>
							</thead>
							<tbody>
								<tr>
									<td>
										{{ $takleiding->firstname.' '.$takleiding->name }}
										{{ ($takleiding->show_nick) ? ' ('.$takleiding->nickname.')' : '' }} - TL
									</td>
									<td>{{ $takleiding->address }}<br>{{ $takleiding->zip.' '.$takleiding->city }}</td>
									<td><a href="mailto:{{ $takleiding->username }}">{{ $takleiding->username }}</a></td>
									<td><a href="{{ preg_replace('/\D/', '', $takleiding->gsm) }}">{{ $takleiding->gsm }}</a></td>
								</tr>
								@foreach ($tak->leaders as $leader)
									@if ($leader->id != $takleiding->id)
										<tr>
											<td>
												{{ $leader->member->firstname.' '.$leader->member->name }}
												{{ ($leader->show_nick) ? ' ('.$leader->nickname.')' : '' }}
											</td>
											<td>{{ $leader->member->address }}<br>{{ $leader->member->zip.' '.$leader->member->city }}</td>
											<td><a href="mailt:{{ $leader->username }}">{{ $leader->username }}</a></td>
											<td><a href="{{ preg_replace('/\D/', '', $leader->gsm) }}">{{ $leader->member->gsm }}</a></td>
										</tr>
									@endif
								@endforeach
							</tbody>
						</table>
					</div>
				@endforeach


				<div class="takken" id="leiding">
					<p>Hier vindt u nog eens alle supercoole leiding van den 18 met foto, zodat u ook op zondag weet wie wie is.</p>
					<h2 class="text-center">Groepsleiding</h2>
					<p><b>E-mailadres:</b> <a href="mailto:groepsleiding@18bp.be">groepsleiding@18bp.be</a><br></p>
					<br>
					<div class="row">
						@foreach ($leaders as $leader)
							@if ($leader->grl())
								<div class="one-half leider">
									<p class="pull-left">
										{{ $leader->member->firstname . ' ' . $leader->member->name }}
										{{ ($leader->show_nick) ? '<br>(' . $leader->nickname . ')' : '' }}
										<br>
										<a href="mailto:{{ $leader->username }}">{{ $leader->username }}</a><br>
										<a href="tel:">{{ $leader->member->gsm }}</a>
									</p>
									<div class="pasfoto">
										<img class="pull-right" src="assets/img/leaders/{{ $leader->img }}" alt="{{ $leader->firstname . ' ' . $leader->name }}">
										<div class="overlay"><span>Klik om te vergroten</span></div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
					<h2 class="text-center clear-both">Leiding</h2>
					<div class="row">
						@foreach ($leaders as $leader)
							@if (!$leader->grl() && $leader->active)
								<div class="one-half leider">
									<p class="pull-left">
										{{ $leader->member->firstname }} {{ $leader->member->name }}
										@if ($leader->show_nick)
											<br>
											{{ '(' . $leader->nickname . ')' }}
										@endif
									</p>
									<div class="pasfoto">
										<img class="pull-right" src="img/leaders/{{ $leader->img }}" alt="{{ $leader->member->firstname . ' ' . $leader->member->name }}">
										<div class="overlay"><span>Klik om te vergroten</span></div>
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
				<div class="photobox">
					<div id="close-button"><i class="fa fa-remove"></i></div>
					<span class="name-overlay"></span>
					<img src="" alt="Leiding 18BP">
				</div>
				<div class="shadow"></div>
			</div>
		</main>
	</div>
@stop