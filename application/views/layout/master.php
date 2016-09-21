<?php $pageName = $this->uri->segment(1) ?>
<!DOCTYPE html>
<html lang="nl">  
    <head>
        <meta charset="utf-8">
        <base href="<?= base_url() ?>">
        <title><?= $meta_title ?> - 18BP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="Den 18 is een bruisende scoutsgroep gelegen in de Langstraat te Borgerhout.">
        <meta name="keywords" content="scouts, borgerhout, 18BP, Corneel Mayné, scouting, antwerpen, jeugdbeweging, langstraat">
        <link rel="icon" type="image/png" href="assets/img/favicon.png">
        <!-- Le styles -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="assets/css/inc/normalize.css" rel="stylesheet">
        <link href="assets/css/inc/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="assets/css/inc/normalize.min.css"> -->
        <!-- <link rel="stylesheet" href="assets/css/inc/bootstrap.min.css"> -->

        <link href="assets/css/style.css" rel="stylesheet">
        <!---->

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
          </script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav"><i class="fa fa-bars"></i></button>
            <a href="home"><img id="logo" src="assets/img/logo.svg" alt="logo 18BP"></a>
            <div class="collapse navbar-collapse navbar-ex1-collapse" id="nav">
                <ul class="nav">
                    <li <?= ($pageName == 'home' || $pageName == '') ? 'class="active"' : '' ?>>
                        <a href="home"><i class="fa fa-home"></i> Hoofdpagina</a>
                    </li>
                    <li <?= ($pageName == 'inschrijven') ? 'class="active"' : '' ?>><a href="inschrijven">Inschrijven</a></li>
                    <li class="dropdown <?= ($pageName == 'den18') ? ' active' : '' ?>">
                        <a href="den18">den 18</a>
                        <ul>
                            <li><a href="den18">Groep</a></li>
                            <li><a href="den18/geschiedenis">Geschiedenis</a></li>
                            <li><a href="den18/uniform">Uniform</a></li>
                        </ul>
                    </li>
                    <li <?= ($pageName == 'schakeltje') ? 'class="active"' : '' ?>><a href="schakeltje">Schakeltje</a></li>
                    <li <?= ($pageName == 'contact') ? 'class="active"' : '' ?>><a href="contact">Contact</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <?php $this->load->view($content); ?>
        </div>
        <footer>
            <?php if(!isset($this->session->userdata['username']) && $meta_title != 'Aanmelden') {
                $this->load->view('auth/login-form');
            }?>
            <?php if (isset($this->session->userdata['username'])): ?>
            	<div id="welkom" class="one-fifth">
            		<h3>Welkom <?=$this->session->userdata('firstname')?></h3><br>
            		<a href="leiding">Naar de leidingspagina</a><br>
                    <a href="logout">Afmelden</a>
            	</div>
            <?php endif ?>
            <div id="disclaimer">
                Design en beheer door Tim van Dijck &copy;
            </div>
        </footer>
        <!-- Le scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
        <script type="text/javascript" src="assets/js/libs/hopper.js"></script>
        <?php if($this->uri->segment(1) == 'home' || $this->uri->segment(1) == 'den18'): ?>
            <script type="text/javascript" src="assets/js/pretty.js"></script>
        <?php endif; ?>
        <?php if ($this->uri->segment(1) == 'contact'): ?>
            <script src="assets/js/libs/autosize.min.js"></script>
            <script src="assets/js/contact.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd-M1FNeu-MO_s-Fmo6Bzxj4UdMn2fjnU&callback=initMap" async defer></script>
        <?php endif ?>

        <script>
            $('.navbar-toggle').click(function() {
                var nav = $('.navbar-toggle').data('toggle');
                $('.'+nav).stop().slideToggle();
                $('.navbar').toggleClass('mobile-active');
            });
        </script>
    </body>
</html>