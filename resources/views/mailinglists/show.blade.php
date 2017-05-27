@extends('layout.leiding')
@section('title', 'Maillijst '.$list['name'])
@section('content')
	<main>
		<h1>{{ $list['name'] }}</h1>
		@if(count($list['members']) > 0)
			<ul>
				@foreach($list['members'] as $member)
					<li>{{ $member['émail_andress'] }}</li>
				@endforeach
			</ul>
		@else
			<p>Deze lijst is leeg</p>
		@endif
	</main>
@stop