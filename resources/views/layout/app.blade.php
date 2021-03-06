<!DOCTYPE html>
<html lang="nl">  
    <head>
        <meta charset="utf-8">
        <base href="{{ url('/') }}">
        <title>@yield('title') - 18BP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="Den 18 is een bruisende scoutsgroep gelegen in de Langstraat te Borgerhout.">
        <meta name="keywords" content="scouts, borgerhout, 18BP, Corneel Mayné, scouting, antwerpen, jeugdbeweging, langstraat">
        <link rel="icon" type="image/png" href="img/favicon.png">
        <!-- Le styles -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <link href="css/style.css" rel="stylesheet">
        <!---->

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js">
          </script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav"><i class="fa fa-bars"></i></button>
            <a href="home"><img id="logo" src="img/logo.svg" alt="logo 18BP"></a>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="nav">
                <ul class="nav">
                    <li {{ (Request::is('home')) ? 'class="active"' : '' }}>
                        <a href="/"><i class="fa fa-home"></i> Hoofdpagina</a>
                    </li>
                    <li {{ (Request::is('inschrijven')) ? 'class="active"' : '' }}><a href="inschrijven">Inschrijven</a></li>
                    <li class="dropdown {{ (Request::is('den18.index')) ? 'active' : '' }}">
                        <a href="den18">den 18</a>
                        <ul>
                            <li><a href="den18">Groep</a></li>
                            <li><a href="den18/geschiedenis">Geschiedenis</a></li>
                            <li><a href="den18/uniform">Uniform</a></li>
                            <li><a href="den18/drank-en-drugs">Drank en drugs</a></li>
                        </ul>
                    </li>
                    <li {{ (Request::is('schakeltje.index')) ? 'class="active"' : '' }}><a href="schakeltje">Schakeltje</a></li>
                    <li {{ (Request::is('contact')) ? 'class="active"' : '' }}><a href="contact">Contact</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        <footer>
            @if(Auth::guest())
                @include('auth.login-form')
            @else
            	<div id="welkom" class="one-fifth">
            		<h3>Welkom {{ Auth::user()->member->firstname }}</h3><br>
            		<a href="leiding">Naar de leidingspagina</a><br>
                    <a href="logout">Afmelden</a>
            	</div>
            @endif
            <div id="disclaimer">
                Design en beheer door Tim van Dijck &copy;
            </div>
        </footer>
        
        <!-- Le scripts -->
        <script type="text/javascript" src="js/libs/jquery-3.3.1.min.js" nonce="{{ $scriptNonce }}"></script>
        <script type="text/javascript" src="js/libs/hopper.js" nonce="{{ $scriptNonce }}"></script>
        @yield('js')
        <?php if('home' || 'den18'): ?>
            <script type="text/javascript" type="text/javascript" src="js/pretty.js" nonce="{{ $scriptNonce }}"></script>
        <?php endif; ?>
        <?php if ('contact'): ?>
            <script type="text/javascript" src="js/libs/autosize.min.js" nonce="{{ $scriptNonce }}"></script>
            <script type="text/javascript" src="js/contact.js" nonce="{{ $scriptNonce }}"></script>
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9mi-HPxHd0MTWm2-GJbzWyyqfy4-Pfqw&callback=initMap" async defer nonce="{{ $scriptNonce }}"></script>
        <?php endif ?>

        <script type="text/javascript" src="js/nav.js" nonce="{{ $scriptNonce }}"></script>
    </body>
</html>