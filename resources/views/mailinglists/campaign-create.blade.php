@extends('layout.leiding')
@section('title', 'Nieuwe mail opstellen')
@section('content')
	<main>
		<form action="{{ route('mailinglijst.send-campaign') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group">
				<div class="form-label">
					<label for="subject">Onderwerp</label>
				</div>
				<div class="form-input">
					<input id="subject" type="text" name="subject">
				</div>
			</div>
			<div class="form-group">
				<div class="form-label">
					<label for="body">Inhoud</label>
				</div>
				<div class="form-input">
					<textarea id="body" name="body"></textarea>
				</div>
			</div>
			@if (isset($lists))
			<div class="form-group">
				<div class="form-label">
					<label for="list">Lijst</label>
				</div>
				<div class="form-group">
					<select name="list" id="list">
						@foreach($lists as $list)
							<option value="{{ $list['id'] }}">{{ $list['name'] }}</option>
						@endforeach
					</select>
				</div>
			</div>
			@else
				<input type="hidden" name="list" value="{{ $list }}">
			@endif
			<div class="form-group">
				<div class="form-input">
					<button class="btn-submit" type="submit">Opslaan</button>
				</div>
			</div>
		</form>
	</main>
@stop
@section('js')
	<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
	<script>CKEDITOR.replace('body');</script>
@stop