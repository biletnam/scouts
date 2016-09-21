<?php $class = ($this->session->userdata('loggedin') ? '' : 'title'); ?>
<div class="parallax-wrapper">
	<main id="news">
		<h2 class="<?= $class ?>">
			NIEUWSOVERZICHT
		</h2>
		<?php if ($this->uri->segment(1) == 'leiding'): ?>
			<div><a href="leiding/nieuws/edit">Maak een nieuw bericht aan</a></div>
		<?php endif; ?>
		<div class="news">
			<?php if (isset($articles)): ?>
				<?php foreach($articles as $article): ?>
					<article class="clear-left" id="<?= $article->id; ?>">
						<h3 class="pull-left"><?= $article->title ?></h3>
						<?php if (Leader::has_permission('nieuws')): ?>
							<div class="controls">
								<a href="leiding/news/delete/<?= $article->id ?>"><i class="fa fa-trash"></i></a>
								<a href="leiding/news/edit/<?= $article->id ?>"><i class="fa fa-pencil"></i></a>
							</div>
						<?php endif ?>
						<div class="clear-left"><?= $article->body ?></div>
						<div class="footer"><?= $article->created ?></div>
					</article>
				<?php endforeach; ?>
			<?php else: ?>
				<p>Er is momenteel geen nieuws.</p>
			<?php endif; ?>
		</div>
	</main>
</div>