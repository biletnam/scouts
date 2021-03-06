<!DOCTYPE html>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<base href="{{ url('/') }}">
	<title>@yield('title') - 18BP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1.0; use-scalable=no;">
	<meta name="description" content="Den 18 is een bruisende scoutsgroep gelegen in de Langstraat te Borgerhout.">
	<link rel="icon" type="image/png" href="img/favicon.png">
	<!-- Le styles -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	<link href="css/style.css" rel="stylesheet">
	<!---->

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
	</script>
	<![endif]-->
	<script type="text/javascript" nonce="{{ $scriptNonce }}">
		window.Laravel = {"csrfToken": "{{ csrf_token() }}"};
	</script>
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav"><i class="fa fa-bars"></i></button>
	<a href="home"><img id="logo" src="img/logo.svg" alt="logo 18BP"></a>
	<div class="collapse navbar-collapse navbar-ex1-collapse" id="nav">
		<ul class="nav">
			<li {{ (Request::is('leiding/dashboard')) ? 'class="active"' : '' }}>
				<a href="leiding/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			</li>
			@if (Auth::user()->hasPermission('nieuws'))
				<li {{ (Request::is('nieuws')) ? 'class="active"' : '' }}>
					<a href="{{ route('nieuws.index') }}"><i class="fa fa-newspaper-o fa-fw"></i>Nieuws</a>
				</li>
			@endif
			@if (Auth::user()->hasPermission('account-management'))
				<li {{ (Request::is('leiding/gebruikers')) ? 'class="active"' : '' }}>
					<a href="{{ route('gebruikers.index') }}"><i class="fa fa-user-circle-o fa-fw"></i>Gebruikers</a>
				</li>
			@endif
			@if (Auth::user()->hasPermission('administratie'))
				<li {{ (Request::is('leiding/wachtlijst')) ? 'class="active"' : '' }}>
					<a href="{{ route('wachtlijst.index') }}"><i class="fa fa-user-plus fa-fw"></i>Wachtlijst</a>
				</li>
			@endif
			<li {{ (Request::is('leiding/ledenlijst')) ? 'class="active"' : '' }}>
				<a href="{{ route('ledenlijst.index') }}"><i class="fa fa-users fa-fw"></i>Ledenlijst</a>
			</li>
			<li {{ (Request::is('leiding/mailinglijst')) ? 'class="active"' : '' }}>
				<a href="{{ route('mailinglijst.index') }}"><i class="fa fa-send fa-fw"></i>Mailinglijst</a>
			</li>

			{{--Mobile hidden--}}
			<li class="mobile-only"><a href="{{ url('/') }}"><i class="fa fa-globe fa-fw"></i> Naar de website</a></li>
			<li class="mobile-only"><a href="leiding/instellingen"><i class="fa fa-lock fa-fw"></i> Wachtwoord wijzigen</a></li>
			<li class="mobile-only"><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Afmelden</a></li>
		</ul>
	</div>
</nav>
@include('partial.success')
@include('partial.errors')
<div class="container" id="leiding">
	@if (strpos(Request::url(), 'edit') === false && strpos(Request::url(), 'create') === false)
		<div class="row">
			<div class="four-fifth">
				@yield('content')
			</div>
			<div class="one-fifth">
				<section>
					<span>{{ 'Welkom '.ucfirst(Auth::user()->firstname).'!' }}<br></span>
					<a href="{{ url('/') }}"><i class="fa fa-globe fa-fw"></i> Naar de website</a><br>
					<a href="leiding/instellingen"><i class="fa fa-lock fa-fw"></i> Wachtwoord wijzigen</a><br>
					<a href="logout"><i class="fa fa-sign-out fa-fw"></i> Afmelden</a>
				</section>
			</div>
		</div>
	@else
		@yield('content')
	@endif
</div>

<script type="text/javascript" nonce="noce-{{ $scriptNonce }}" src="js/libs/jquery-3.3.1.min.js"></script>
<script type="text/javascript" nonce="noce-{{ $scriptNonce }}" src="js/libs/select2.min.js"></script>
<script type="text/javascript" nonce="noce-{{ $scriptNonce }}" src="js/libs/sweetalert.min.js"></script>
<script type="text/javascript" nonce="noce-{{ $scriptNonce }}" src="js/libs/ckeditor.js"></script>
<script type="text/javascript" nonce="noce-{{ $scriptNonce }}" src="js/admin.js"></script>
@yield('js')

</body>
</html>