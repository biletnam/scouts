<main>
	<h3><?= empty($leader->id) ? 'Maak een '.$type.' aan' : 'Wijzig een '.$leader->type ?></h3>
	<?= validation_errors() ?>
	<form action="leiding/gebruikers/save<?= (!empty($leader->id)) ? '/'.$leader->id : '' ?>" method="POST" class="edit">
		<ul>
			<?php if (!empty($leader->firstname)): ?>
				<li>
					<label>Voornaam</label>
					<p class="pull-right"><?= $leader->firstname ?></p>
				</li>
			<?php endif ?>
			<?php if (!empty($leader->name)): ?>
				<li>
					<label>Achternaam</label>
					<p class="pull-right"><?= $leader->name ?></p>
				</li>
			<?php endif ?>
			<li>
				<label>Kapoenen -of welpennaam</label>
				<input type="text" name="nickname" value="<?= (!empty($leader->nickname)) ? $leader->nickname : '' ?>">
			</li>
			<li>
				<input type="checkbox" name="show_nick" id="show_nick" value="1" <?= ($leader->show_nick) ? 'checked' : '' ?>>
				<label for="show_nick">Kapoenen -of welpennaam tonen</label>
			</li>
			<li>
				<label>Gebruikersnaam</label>
				<input type="email" name="username" value="<?= (!empty($leader->username)) ? $leader->username : '' ?>">
			</li>
			<li>
				<?php if (!empty($leader->type)): ?>
					<input type="hidden" name="type" value="<?= $leader->type ?>">
				<?php else: ?>
					<label>Type</label>
					<select name="type">
						<option value="leider">Leider</option>
						<option value="admin">Administrator</option>
						<option value="webmaster">Webmaster</option>
						<option value="groepsleider">Groepsleider</option>
					</select>
				<?php endif ?>
			</li>
			<li><button type="submit" class="btn-submit">Opslaan</button><a class="cancel" href="leiding/gebruikers">Annuleer</a></li>
		</ul>
	</form>
</main>