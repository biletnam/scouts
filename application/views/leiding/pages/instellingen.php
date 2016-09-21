<main>
	<h2>Instellingen</h2>
	<p class="errors"><?=$this->session->flashdata('errors')?><?=$this->session->flashdata('wachtwoord');?></p>
	<form action="leiding/instellingen/edit" id="instellingen">
		<ul>
			<li><label for="">Huidig wachtwoord</label></li>
			<li><input type="password" name="huidig_wachtwoord" id=""></li>
			<li><label for="">Nieuw wachtwoord</label></li>
			<li><input type="password" name="nieuw_wachtwoord" id=""></li>
			<li><label for="">Bevestig wachtwoord</label></li>
			<li><input type="password" name="bevestig_wachtwoord" id=""></li>
		</ul>
		<button type="submit">Wijzigen</button>
		<a href="leiding" >Annuleren</a>
	</form>
</main>