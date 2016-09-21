<main>
	<h3><?= empty($kid->id) ? 'Voeg een lid toe bij '.$tak : 'Wijzig lid bij '.$kid->tak ?></h3>
	<?= validation_errors() ?>
	<form action="leiding/wachtlijst/save<?= (!empty($kid->id)) ? '/'.$kid->id : ''?>" method="POST" class="edit">
		<ul>
			<li>
				<label for="voornaam">Voornaam</label>
				<input type="text" name="firstname" value="<?= (!empty($kid->firstname)) ? $kid->firstname : '' ?>">
			</li>
			<li>
				<label>Achternaam</label>
				<input type="text" name="name" value="<?= (!empty($kid->name)) ? $kid->name : '' ?>">
			</li>
			<li>
				<label>Geboortedatum (DD/MM/JJJJ)</label>
				<input type="text" name="birthdate" value="<?= (!empty($kid->birthdate)) ? $kid->birthdate : '' ?>">
			</li>
			<li>
				<label>Adres</label>
				<input type="text" name="address" value="<?= (!empty($kid->address)) ? $kid->address : '' ?>">
			</li>
			<li>
				<label>Postcode</label>
				<input type="text" name="zip" value="<?= (!empty($kid->zip)) ? $kid->zip : '' ?>">
			</li>
			<li>
				<label>Plaats</label>
				<input type="text" name="city" value="<?= (!empty($kid->city)) ? $kid->city : '' ?>">
			</li>
			<li>
				<label>Telefoonnummer</label>
				<input type="text" name="tel" value="<?= (!empty($kid->tel)) ? $kid->tel : '' ?>">
			</li>
			<li>
				<label>GSM-nummer</label>
				<input type="text" name="gsm" value="<?= (!empty($kid->gsm)) ? $kid->gsm : '' ?>">
			</li>
			<li>
				<label>E-mailadres</label>
				<input type="email" name="email" value="<?= (!empty($kid->email)) ? $kid->email : '' ?>">
			</li>
			<li>
				<?php if (isset($tak)): ?>
					<input type="hidden" name="tak" value="<?= $tak ?>">
				<?php else: ?>
					<label>Tak</label>
					<select name="tak">
						<option value="Kapoenen" <?= (isset($kid) && $kid->tak == 'Kapoenen' || $tak == 'Kapoenen') ? 'selected="selected"' : '' ?>>Kapoenen</option>
						<option value="Welpen" <?= (isset($kid) && $kid->tak == 'Welpen' || $tak == 'Welpen') ? 'selected="selected"' : '' ?>>Welpen</option>
						<option value="Jojo's" <?= (isset($kid) && $kid->tak == 'Jojo\'s' || $tak == 'Jojo\'s') ? 'selected="selected"' : '' ?>>Jojo's</option>
						<option value="Givers" <?= (isset($kid) && $kid->tak == 'Givers' || $tak == 'Givers') ? 'selected="selected"' : '' ?>>Givers</option>
					</select>
				<?php endif ?>
			</li>
			<li>
				<label>Jaar</label>
				<select name="year">
					<option value="1">1ejaars</option>
					<option value="2">2ejaars</option>
					<?php if ($kid->tak != 'Kapoenen' && $tak != 'Kapoenen'): ?>
						<option value="3">3ejaars</option>
					<?php endif ?>
				</select>
			</li>
			<li>
				<button type="submit" name="submit" class="btn-submit">Opslaan</button>
				<a class="cancel" href="leiding/wachtlijst">Annuleer</a>
			</li>
		</ul>
	</form>
</main>