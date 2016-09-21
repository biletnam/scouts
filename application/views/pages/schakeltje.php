<header><img src="assets/img/slide3.jpg" alt="header"></header>
<div class="parallax-wrapper">
	<main>
		<h1 class="title">SCHAKELTJE</h1>
		<p>
			Het Schakeltje is ons maandelijks schrift waarin u alles vindt dat u moet weten over die maand.
			Het maandprogramma staat per tak uitgeschreven met alle benodigdheden.
		</p>
		<p>Hieronder kan u de recentste schakeltjes downloaden.</p>
		<ul id="schakel">
			<?php foreach ($schakels as $schakeltje): ?>
				<li class="schakeltje"><a href="schakeltjes/<?= $schakeltje->name ?>.pdf" target="_blank"><?= $schakeltje->name ?></a></li>
			<?php endforeach ?>
		</ul>
			<?php if ($this->session->userdata('loggedin')): ?>
				<h3>Schakeltje toevoegen</h3>
				<div class="errors"><?= ($this->session->flashdata('errors') !== NULL) ? $this->session->flashdata('errors') : '' ?></div>
				<form action="schakeltje/add" method="POST" enctype="multipart/form-data">
					<ul>
						<li>
							<label for="file" id="file-label">
								<span>Klik om te uploaden</span>
								<input type="file" name="schakeltje" id="file" size="20">
							</label>
						</li>
						<li><button type="submit">Uploaden</button></li>
					</ul>
				</form>
			<?php endif ?>
		</div>
	</main>	
</div>