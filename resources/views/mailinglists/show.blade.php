@extends('layout.leiding')
@section('title', 'Maillijst '.$list['name'])
@section('content')
	<main>
		<h1>{{ $list['name'] }}</h1>
		<p><a href="{{ route('mailinglijst.new-campaign-for-list', [$list['id']]) }}"><i class="fa fa-plus"></i> nieuwe mail verzenden</a></p>
		@if(count($list['members']) > 0)
			<ul>
				@foreach($list['members'] as $member)
					@if ($member['status'] !== 'unsubscribed')
						<li>{{ $member['email_address'] }}</li>
					@endif
				@endforeach
			</ul>
		@else
			<p>Deze lijst is leeg</p>
		@endif
	</main>
@stop