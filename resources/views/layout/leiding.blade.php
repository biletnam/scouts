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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	<link href="css/style.css" rel="stylesheet">
	<!---->

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
	</script>
	<![endif]-->
	<script>
		window.Laravel = <?php echo json_encode([
			'csrfToken' => csrf_token(),
		]); ?>
	</script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav"><i class="fa fa-bars"></i></button>
	<a href="home"><img id="logo" src="img/logo.svg" alt="logo 18BP"></a>
	<div class="collapse navbar-collapse navbar-ex1-collapse" id="nav">
		<ul class="nav">
			<li {{ (Request::is('leiding/dashboard')) ? 'class="active"' : '' }}>
				<a href="leiding/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
			</li>
			@if (Auth::user()->hasPermission('nieuws'))
				<li {{ (Request::is('nieuws')) ? 'class="active"' : '' }}>
					<a href="{{ route('nieuws.index') }}">Nieuws</a>
				</li>
			@endif
			@if (Auth::user()->hasPermission('account-management'))
				<li {{ (Request::is('leiding/gebruikers')) ? 'class="active"' : '' }}>
					<a href="{{ route('gebruikers.index') }}">Gebruikers</a>
				</li>
			@endif
			@if (Auth::user()->hasPermission('administratie'))
				<li {{ (Request::is('leiding/wachtlijst')) ? 'class="active"' : '' }}>
					<a href="{{ route('wachtlijst.index') }}">Wachtlijst</a>
				</li>
			@endif
			<li {{ (Request::is('leiding/ledenlijst')) ? 'class="active"' : '' }}>
				<a href="{{ route('ledenlijst.index') }}">Ledenlijst</a>
			</li>
			<li {{ (Request::is('leiding/mailinglijst')) ? 'class="active"' : '' }}>
				<a href="{{ route('mailinglijst.index') }}">Mailinglijst</a>
			</li>
		</ul>
	</div>
</nav>
<div class="container" id="leiding">
	<img id="background-img" src="img/leidingkenteken.jpg" alt="leidingkenteken">
	@if (strpos(Request::url(), 'edit') === false && strpos(Request::url(), 'create') === false)
		<div class="row">
			<div class="four-fifth">
				@yield('content')
			</div>
			<div class="one-fifth">
				<section>
					<span>{{ 'Welkom '.ucfirst(Auth::user()->firstname).'!' }}<br></span>
					<a href="{{ url('/') }}"><i class="fa fa-globe"></i> Naar de website</a><br>
					<a href="leiding/instellingen"><i class="fa fa-lock"></i> Wachtwoord wijzigen</a><br>
					<a href="logout"><i class="fa fa-sign-out"></i> Afmelden</a>
				</section>
			</div>
		</div>
	@else
		@yield('content')
	@endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
	$(function() { setTimeout(function() { $('p.success').slideUp(); }, 3000); });
	var base_url = "{{ url('/') }}";
	$('.navbar-toggle').click(function() {
		var nav = $('.navbar-toggle').data('toggle');
		$('.'+nav).stop().slideToggle();
		$('.navbar').toggleClass('mobile-active');
	});
	$('a.add-role').click(function(e) {
		e.preventDefault();
		$('#add-role').show();
	});
	$('#leader').select2();
</script>
@yield('js')

</body>
</html>