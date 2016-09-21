<main>
	<h2>Gebruikers</h2>
	<?php foreach ($leaders as $index => $type): ?>
		<h3><?= ucfirst($index) ?></h3>
		<a href="leiding/gebruikers/edit?type=<?= $index ?>"><span class="fa fa-plus"></span> Voeg toe</a>
		<table class="table table-striped users">
			<thead>
				<tr>
					<th>Voornaam</th>
					<th>Achternaam</th>
					<th>Gebruikersnaam</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($type as $leader): ?>
					<tr>
						<td><?= ($leader->member_id != 0) ? $leader->firstname : 'Leiding'?></td>
						<td><?= ($leader->member_id != 0) ? $leader->name : 'Leiding'?></td>
						<td><?= ($leader->member_id != 0) ? $leader->username : 'leiding@18bp.be'?></td>
						<td><a href="leiding/ledenlijst/details/<?= $leader->member_id?>"><i class="fa fa-eye"></i></a></td>
						<td><a href="leiding/gebruikers/edit/<?= $leader->id?>"><i class="fa fa-pencil"></i></a></td>
						<td><a href="leiding/gebruikers/delete/<?= $leader->id?>"><i class="fa fa-trash"></i></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	<?php endforeach ?>	
</main>