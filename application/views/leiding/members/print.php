<h2>Ledenlijst</h2>
<h3><?= ($name != 'jojos') ? ucfirst($name) : 'Jojo\'s' ?></h3>
<style type="text/css">
	input[type='checkbox']:not(:first-child) { margin-left: 15px;}
	input[type='checkbox'] { margin-right: 5px;}
</style>
<form id="checks" action="leiding/ledenlijst/print_lijst?tak=<?= $name ?>" method="POST">
	<input type="checkbox" name="geboortedatum" value="geboortedatum" <?= ($args['geboortedatum'] != NULL) ? 'checked' : '' ?>>Geboortedatum
	<input type="checkbox" name="gsm" value="gsm" <?= ($args['gsm'] != NULL) ? 'checked' : '' ?>>GSM-nummer
	<input type="checkbox" name="tel" value="tel" <?= ($args['tel'] != NULL) ? 'checked' : '' ?>>Telefoonnummer
	<input type="checkbox" name="email" value="email" <?= ($args['email'] != NULL) ? 'checked' : '' ?>>E-mailadres
	<input type="checkbox" name="jaar" value="jaar" <?= ($args['jaar'] != NULL) ? 'checked' : '' ?>>Jaar
	<br>
	<a id="printLink" href=""><span class="glyphicon glyphicon-print"></span> Printen</a>
</form>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Voornaam</th>
			<th>Achternaam</th>
			<?php if (in_array('geboortedatum', $args)): ?>
				<th>Geboortedatum</th>
			<?php endif ?>
			<?php if (in_array('gsm', $args)): ?>
				<th>GSM</th>
			<?php endif ?>
			<?php if (in_array('tel', $args)): ?>
				<th>Telefoon</th>
			<?php endif ?>
			<?php if (in_array('email', $args)): ?>
				<th>E-mailadres</th>
			<?php endif ?>
			<?php if (in_array('jaar', $args)): ?>
				<th>Jaar</th>
			<?php endif ?>
			<th>Aanwezig</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tak as $member): ?>
			<tr>
				<td><?= $member['voornaam'] ?></td>
				<td><?= $member['achternaam'] ?></td>
				<?php if (in_array('geboortedatum', $args)): ?>
					<td><?= $member['geboortedatum'] ?></td>
				<?php endif ?>
				<?php if (in_array('gsm', $args)): ?>
					<td><?= $member['gsm'] ?></td>
				<?php endif ?>
				<?php if (in_array('tel', $args)): ?>
					<td><?= $member['tel'] ?></td>
				<?php endif ?>
				<?php if (in_array('email', $args)): ?>
					<td><?= $member['email'] ?></td>
				<?php endif ?>
				<?php if (in_array('jaar', $args)): ?>
					<td><?= $member['jaar'] ?>ejaars</td>
				<?php endif ?>
				<td style="border-left: 2px solid #ddd; border-right: 2px solid #ddd;"></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<script src="http://code.jquery.com/jquery-1.9.0.js" type="text/javascript"></script>
<script>
	$(function() {
		$("#checks").on("change", "input:checkbox", function() {
			$("#checks").submit();
		});
		$("#printLink").click(function(event) {
			event.preventDefault();
			window.print();
		});
	});
</script>