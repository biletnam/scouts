<main>
	<h2 class="title">Aanmelden</h2>
	<div class="login">
		<p>Welkom op de leidingspagina van den 18! Gelieve in te loggen met je 18bp e-mailadres.</p>
		<p class="errors"><?= ($this->session->flashdata('login-errors') !== NULL) ? $this->session->flashdata('login-errors') : '' ?></p>
		<div id="login_form" class="center">
			<?php $this->load->view('auth/login-form') ?>
			<sub><a href="http://www.youtube.com/watch?v=dQw4w9WgXcQ">Wachtwoord vergeten?</a></sub>
		</div>
	</div>
</main>