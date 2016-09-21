<main>
	<h3><?= empty($member->id) ? 'Voeg een lid toe bij '.$tak : 'Wijzig lid bij '.$member->tak ?></h3>
	<?= validation_errors() ?>
	<form action="leiding/ledenlijst/save<?= (!empty($member->id)) ? '/'.$member->id : ''?>" method="POST" class="edit">
		<ul>
			<li>
				<label for="voornaam">Voornaam</label>
				<input type="text" name="firstname" value="<?= (!empty($member->firstname)) ? $member->firstname : '' ?>">
			</li>
			<li>
				<label>Achternaam</label>
				<input type="text" name="name" value="<?= (!empty($member->name)) ? $member->name : '' ?>">
			</li>
			<li>
				<label>Geboortedatum (DD/MM/JJJJ)</label>
				<input type="text" name="birthdate" value="<?= (!empty($member->birthdate)) ? $member->birthdate : '' ?>">
			</li>
			<li>
				<label>Adres</label>
				<input type="text" name="address" value="<?= (!empty($member->address)) ? $member->address : '' ?>">
			</li>
			<li>
				<label>Postcode</label>
				<input type="text" name="zip" value="<?= (!empty($member->zip)) ? $member->zip : '' ?>">
			</li>
			<li>
				<label>Plaats</label>
				<input type="text" name="city" value="<?= (!empty($member->city)) ? $member->city : '' ?>">
			</li>
			<li>
				<label>Telefoonnummer</label>
				<input type="text" name="tel" value="<?= (!empty($member->tel)) ? $member->tel : '' ?>">
			</li>
			<li>
				<label>GSM-nummer</label>
				<input type="text" name="gsm" value="<?= (!empty($member->gsm)) ? $member->gsm : '' ?>">
			</li>
			<li>
				<label>E-mailadres</label>
				<input type="email" name="email" value="<?= (!empty($member->email)) ? $member->email : '' ?>">
			</li>
			<li>
				<label>Tak</label>
				<select name="tak">
					<option value="Kapoenen" <?= ($member->tak == 'Kapoenen' || $tak == 'Kapoenen') ? 'selected="selected"' : '' ?>>Kapoenen</option>
					<option value="Welpen" <?= ($member->tak == 'Welpen' || $tak == 'Welpen') ? 'selected="selected"' : '' ?>>Welpen</option>
					<option value="Jojo's" <?= ($member->tak == 'Jojo\'s' || $tak == 'Jojo\'s') ? 'selected="selected"' : '' ?>>Jojo's</option>
					<option value="Givers" <?= ($member->tak == 'Givers' || $tak == 'Givers') ? 'selected="selected"' : '' ?>>Givers</option>
					<option value="Jins" <?= ($member->tak == 'Jins' || $tak == 'Jins') ? 'selected="selected"' : '' ?>>Jins</option>
					<option value="Leiding" <?= ($member->tak == 'Leiding' || $tak == 'Leiding') ? 'selected="selected"' : '' ?>>Leiding</option>
				</select>
			</li>
			<li>
				<label>Jaar</label>
				<select name="year">
					<option value="1">1ejaars</option>
					<?php if ($member->tak != 'Jins' && $tak != 'Jins'): ?>
						<option value="2">2ejaars</option>
						<?php if ($member->tak != 'Kapoenen' && $tak != 'Kapoenen'): ?>
							<option value="3">3ejaars</option>
						<?php endif ?>
					<?php endif ?>
				</select>
			</li>
			<li>
				<label for="betaald">Betaald</label>
				<input type="checkbox" name="paid" value="1" <?= (!empty($member->paid) && $member->paid == 1) ? 'checked' : '' ?>>
			</li>
			<li><button type="submit" name="submit" class="btn-submit">Opslaan</button><a class="cancel" href="leiding/ledenlijst">Annuleer</a></li>
		</ul>
	</form>
</main>