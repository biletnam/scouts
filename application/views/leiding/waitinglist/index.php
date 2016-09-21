<main class="leden">
	<p class="pull-right"><a href="leiding/wachtlijst/excelify"><img src="assets/img/excel.gif" alt="Excelify"></a></p>
	<h2>Wachtlijst</h2>
	<?php foreach ($waitinglist as $index => $tak): ?>
		<div>
			<h3><?= ($index !== 'jojos') ? ucfirst($index) : 'Jojo\'s' ?>: <?= count($tak['priority']) + count($tak['regular']) ?></h3>
			<a class="pull-right print" href="leiding/wachtlijst/print_lijst?tak=<?= $index ?>">Print wachtlijst</a>


			<div class="priority">
				<h4>Broertjes en zusjes: <?= count($tak['priority']) ?></h4>
				<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
					<a href="leiding/wachtlijst/edit?tak=<?= $index ?>" class="add"><i class="fa fa-plus"></i> Nieuw broertje/zusje</a>
				<?php endif ?>

				<button class="<?= $index ?>">E-mailadressen kopiëren</button>
				<div class="email-list" id="<?= $index ?>">
					<b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
					<?php
						$email = '';
						foreach ($tak['priority'] as $kid) {
							if (strpos($email, $kid->email) === FALSE) { $email.=$kid->email; }
						}
					?>
					<input type="hidden" value="<?= $email ?>" class="emails">
				</div>

				<table class="table table-striped leden">
					<thead>
						<tr>
							<th>Voornaam</th>
							<th>Achternaam</th>
							<th>Geboortedatum</th>
							<th>GSM</th>
							<th>Telefoon</th>
							<th>E-mailadres</th>
							<th>Jaar</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($tak['priority']) > 0): ?>
							<?php foreach ($tak['priority'] as $kid): ?>
								<tr>
									<td><?= $kid->firstname ?></td>
									<td><?= $kid->name ?></td>
									<td><?= $kid->birthdate ?></td>
									<td><?= $kid->gsm ?></td>
									<td><?= $kid->tel ?></td>
									<td><?= $kid->email ?></td>
									<td><?= $kid->year ?></td>
									<td><a href="leiding/wachtlijst/details/<?= $kid->id ?>"><i class="fa fa-eye"></i></a></td>
									<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
										<td><a href="leiding/wachtlijst/edit/<?= $kid->id ?>"><i class="fa fa-pencil"></i></a></td>
										<td><a href="leiding/wachtlijst/edit/<?= $kid->id ?>"><i class="fa fa-trash"></i></a></td>
									<?php endif ?>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr><td colspan="7" class="text-center">Er zijn geen wachtende broertjes/zusjes voor deze tak</td></tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>

			<div class="regular">
				<h4>Nieuwe kinderen: <?= count($tak['regular']) ?></h4>
				<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
					<a href="leiding/wachtlijst/edit?tak=<?= $index ?>" class="add"><i class="fa fa-plus"></i> Nieuw broertje/zusje</a>
				<?php endif ?>

				<button class="<?= $index ?>">E-mailadressen kopiëren</button>
				<div class="email-list" id="<?= $index ?>">
					<b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
					<?php
						$email = '';
						foreach ($tak['regular'] as $kid) {
							if (strpos($email, $kid->email) === FALSE) { $email.=$kid->email; }
						}
					?>
					<input type="hidden" value="<?= $email ?>" class="emails">
				</div>

				<table class="table table-striped leden">
					<thead>
						<tr>
							<th>Voornaam</th>
							<th>Achternaam</th>
							<th>Geboortedatum</th>
							<th>GSM</th>
							<th>Telefoon</th>
							<th>E-mailadres</th>
							<th>Jaar</th>
						</tr>
					</thead>
					<tbody>
						<?php if (count($tak['regular']) > 0): ?>
							<?php foreach ($tak['regular'] as $kid): ?>
								<tr>
									<td><?= $kid->firstname ?></td>
									<td><?= $kid->name ?></td>
									<td><?= $kid->birthdate ?></td>
									<td><?= $kid->gsm ?></td>
									<td><?= $kid->tel ?></td>
									<td><?= $kid->email ?></td>
									<td><?= $kid->year ?></td>
									<td><a href="leiding/wachtlijst/details/<?= $kid->id ?>"><i class="fa fa-eye"></i></a></td>
									<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
										<td><a href="leiding/wachtlijst/edit/<?= $kid->id ?>"><i class="fa fa-pencil"></i></a></td>
										<td><a href="leiding/wachtlijst/edit/<?= $kid->id ?>"><i class="fa fa-trash"></i></a></td>
									<?php endif ?>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
							<tr><td colspan="7" class="text-center">Er zijn geen wachtende kinderen voor deze tak</td></tr>
						<?php endif ?>
					</tbody>
				</table>
			</div>


		</div>
	<?php endforeach ?>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
	$(function() {
		$("button").click(function(event) {
			event.preventDefault();
			$(this).siblings('.emails').select();
			document.execCommand('copy');
			
		});
	});
</script>