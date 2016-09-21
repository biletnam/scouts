<main>
	<h3>
		<?= $member->firstname.' '.$member->name?>
		<?= (strtolower($member->tak) == 'leiding' && isset($member->nickname)) ? '(' . $member->nickname . ')' : '' ?>
	</h3>
	<ul class="details">
		<li><?= $member->year ?>ejaars <?= strtolower($member->tak) ?></li>
		<li><?= $member->birthdate ?></li>
		<li><?= $member->address ?><br><?= $member->zip ?> <?= $member->city ?></li>	
		<li>
			<?php if (isset($member->tel)): ?>
				<i class="fa fa-phone"></i>
				<a href="tel:<?= str_replace('/', '', str_replace(' ', '', str_replace('+', '00', $member->tel))) ?>"><?= $member->tel ?></a></li>
			<?php endif ?>
		<li>
			<?php if (isset($member->gsm)): ?>
				<i class="fa fa-mobile"></i>
				<a href="tel:<?= str_replace('/', '', str_replace(' ', '', str_replace('+', '00', $member->gsm))) ?>"><?= $member->gsm ?></a>
			<?php endif ?>
		</li>
		<li>
			<i class="fa fa-envelope-o"></i>
			<a href="mailto:<?= $member->email ?>"><?= $member->email ?></a>
		</li>
		<?php if ($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'webmaster'): ?>
			<li>Betaald: <i class="fa fa-<?= (!empty($member->paid) && $member->paid == 1) ? 'ok' : 'remove' ?>"></i></li>
		<?php endif ?>
	</ul>
	<a href="leiding/ledenlijst"><i class="fa fa-long-arrow-left"></i> Terug naar ledenlijst</a>
</main>