<main>
	<h3><?= empty($article->id) ? 'Voeg een artikel toe' : 'Artikel wijzigen '?></h3>
	<?= validation_errors(); ?>
	<form action="leiding/nieuws/save/<?= $article->id ?>" method="post">
		<ul class="nieuws-edit">
			<li><input type="text" name="title" class="edit-title" placeholder="Titel" value="<?= $article->title ?>"></li>
			<li><textarea name="body" class="edit-body" cols="30" rows="10"><?= $article->body ?></textarea></li>
			<li>
				<button type="submit" class="btn-submit">Opslaan</button>
				<a class="cancel" href="leiding/nieuws">Annuleer</a>
			</li>
		</ul>
	</form>
	<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
	<script type="text/javascript">CKEDITOR.replace('body');</script>
</main>
