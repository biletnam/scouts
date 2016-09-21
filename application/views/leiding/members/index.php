<main class="leden">
	<p class="pull-right"><a href="leiding/ledenlijst/excelify"><img src="assets/img/excel.gif" alt="Excelify"></a></p>
	<h2>Ledenoverzicht</h2>
	<?php foreach ($members as $index => $tak): ?>
		<div>
			<h3><?= ($index !== 'jojos') ? ucfirst($index) : 'Jojo\'s' ?>: <?= count($tak) ?></h3>
			<a class="pull-right print" href="leiding/ledenlijst/print_lijst?tak=<?= $index ?>">Print ledenlijst</a>

			<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
				<a href="leiding/ledenlijst/edit?tak=<?= $index ?>" class="add"><i class="fa fa-plus"></i> Nieuw lid</a>
			<?php endif ?>

			<button class="<?= $index ?>">E-mailadressen kopiëren</button>
			<div class="email-list" id="<?= $index ?>">
				<b>Kopieer deze e-mailadressen naar het CC vak van je mail: </b><br>
				<?php
					$email = '';
					foreach ($tak as $member) {
						if (strpos($email, $member->email) === FALSE) { $email.=$member->email; }
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
						<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
							<th class="betaald">Betaald</th>
						<?php endif ?>
					</tr>
				</thead>
				<tbody>
					<?php if (count($tak) > 0): ?>
						<?php foreach ($tak as $member): ?>
							<tr>
								<td><?= $member->firstname ?></td>
								<td><?= $member->name ?></td>
								<td><?= $member->birthdate ?></td>
								<td><?= $member->gsm ?></td>
								<td><?= $member->tel ?></td>
								<td><?= $member->email ?></td>
								<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
									<td class="paid">
										<i class="fa <?= ($member->paid) ? 'fa-check' : 'fa-remove' ?>" data-id="<?= $member->id ?>"></i>
									</td>	
								<?php endif ?>
								<td><a href="leiding/ledenlijst/details/<?= $member->id ?>"><i class="fa fa-eye"></i></a></td>
								<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
									<td><a href="leiding/ledenlijst/edit/<?= $member->id ?>"><i class="fa fa-pencil"></i></a></td>
									<td><a href="leiding/ledenlijst/edit/<?= $member->id ?>"><i class="fa fa-trash"></i></a></td>
								<?php endif ?>
							</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr><td colspan="6">Er zijn geen leden in deze tak</td></tr>
					<?php endif ?>
				</tbody>
			</table>
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
		$('.paid i').click(function() {
			$el = $(this);
			$.get('leiding/ledenlijst/toggle_paid/'+ $(this).data('id'), function(result) {
				$el.toggleClass('fa-check');
				$el.toggleClass('fa-remove');
			});
		});
	});
</script>