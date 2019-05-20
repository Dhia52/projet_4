<?php
$this->setTitle("Billet simple pour l'Alaska - Liste des épisodes");
$this->setJavascript(['episodes.js']);?>

<?php require('View/nav.php'); ?>
<div class="container-fluid">
	<div class="card text-center" id="card">
		<div class="card-body">
			<h2 class="card-title">Episodes</h2>
			<div class="row justify-content-around">
<?php
foreach ($list as $episode)
{
?>
				<div class="card text-white bg-dark col-md-3 col-sm-5 my-4">
				<h3 class="card-header">Episode <?= $episode->id() ?></h3>
					<div class="card-body d-flex flex-column justify-content-center">
						<div class="card-text d-flex flex-column">
							<h5><?= $this->sanitize($episode->title()) ?></h5>
							<a href="?controller=episodes&amp;action=read&amp;id=<?= $episode->id() ?>" class="btn btn-primary">Lire</a>
						</div>
					</div>
					<p class="card-footer">
					<i>Publié le : <?= $this->sanitize($episode->postDate()) ?><br />
<?php
	if(null !== $episode->updateDate())
	{
		echo ' Mise à jour le : ' . $this->sanitize($episode->updateDate());
	}
?>
					</i></p>
				</div>
<?php
}
?>
			</div>
			<div class="card-footer">
				<a href="?controller=episodes&amp;action=list#card" class="btn btn-primary">Remonter</a>
			</div>
		</div>
	</div>
</div>
