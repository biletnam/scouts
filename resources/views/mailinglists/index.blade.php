@extends('layout.leiding')
@section('title', 'Mailinglijsten')
@section('content')
	<main>
		<h1>Mailinglijsten</h1>
		<div class="row">
			<div class="col-md-12">
				<a href="{{ route('mailinglijst.new-campaign') }}"><i class="fa fa-send"></i> Nieuwe mail versturen</a>
			</div>
		</div>
		@foreach($lists as $list)
			<div class="row">
				<div class="col-md-12">
					@if($list['stats']['member_count'] > 0)
						<a href="{{ route('mailinglijst.show', [$list['id']]) }}">
					@endif
							<h4>{{ $list['name'] }} ({{ $list['stats']['member_count'] }})</h4>
					@if($list['stats']['member_count'] > 0)
						</a>
					@endif
				</div>
			</div>
		@endforeach
	</main>
@stop