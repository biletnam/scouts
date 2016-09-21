<?php $pageName = $this->uri->segment(2); ?>

<!DOCTYPE html>
	<html lang="nl">  
		<head>
		<meta charset="utf-8">
		<base href="<?=base_url();?>">
		<title>18BP - <?= $meta_title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1.0; use-scalable=no;">
		<meta name="description" content="Den 18 is een bruisende scoutsgroep gelegen in de Langstraat te Borgerhout.">
		<meta name="keywords" content="scouts, borgerhout, 18BP, Corneel Mayné, scouting, antwerpen, jeugdbeweging, langstraat">
		<link rel="icon" type="image/png" href="assets/img/favicon.png">
		<!-- Le styles -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,700,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href="assets/css/inc/normalize.css" rel="stylesheet">
		<link href="assets/css/inc/bootstrap.min.css" rel="stylesheet">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.min.css"> -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="assets/css/inc/normalize.min.css">
		<link rel="stylesheet" href="assets/css/inc/bootstrap.min.css">

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
						<a href="leiding/home"><i class="fa fa-dashboard"></i> Dashboard</a>
					</li>
					<?php if (Leader::has_permission('nieuws') ): ?>
						<li <?= ($pageName == 'nieuws') ? 'class="active"' : '' ?>><a href="leiding/nieuws">Nieuws</a></li>
					<?php endif ?>
					<?php if (Leader::has_permission('account_management')): ?>
						<li <?= ($pageName == 'gebruikers') ? 'class="active"' : '' ?>><a href="leiding/gebruikers">Gebruikers</a></li>
					<?php endif ?>
					<?php if (Leader::has_permission('administratie')): ?>
						<li <?= ($pageName == 'wachtlijst') ? 'class="active"' : '' ?>><a href="leiding/wachtlijst">Wachtlijst</a></li>
					<?php endif ?>
					<li <?= ($pageName == 'ledenlijst') ? 'class="active"' : '' ?>><a href="leiding/ledenlijst">Ledenlijst</a></li>
					<li <?= ($pageName == 'instellingen') ? 'class="active"' : '' ?>><a href="leiding/instellingen">Instelligen</a></li>
					<li <?= ($pageName == 'nuttig') ? 'class="active"' : '' ?>><a href="leiding/nuttig">Nuttige links</a></li>
				</ul>
			</nav>
		</div>
		<div class="container" id="leiding">
			<?php if ($this->uri->segment(3) != 'edit'): ?>
				<div class="row">
					<div class="four-fifth">
						<?php $this->load->view($content); ?>
					</div>
					<div class="one-fifth">
						<section>
							<span><?= 'Welkom '.ucfirst($this->session->userdata['firstname']).'!' ?><br></span>
							<?= anchor(base_url(), '<i class="fa fa-globe"></i> Naar de website') ?> <br>
							<?= anchor('logout', '<i class="fa fa-sign-out"></i> Afmelden') ?>
						</section>
					</div>
				</div>
			<?php else: ?>
				<?php $this->load->view($content) ?>
			<?php endif ?>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>
			$('.navbar-toggle').click(function() {
                var nav = $('.navbar-toggle').data('toggle');
                $('.'+nav).stop().slideToggle();
                $('.navbar').toggleClass('mobile-active');
            });
		</script>
	</body>
</html>