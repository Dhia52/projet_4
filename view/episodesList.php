<?php
$title = "Billet simple pour l'Alaska - Liste des épisodes";
$script = '<script src="assets/js/episodes.js"></script>';?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<div class="container-fluid">
	<div class="card text-center">
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
							<h5><?= $episode->title() ?></h5>
							<a href="episodes.php?id=<?= $episode->id() ?>" class="btn btn-primary">Lire</a>
						</div>
					</div>
					<p class="card-footer">
					<i>Publié le : <?= $episode->postDate() ?><br />
<?php
	if(null !== $episode->updateDate())
	{
		echo ' Mise à jour le : ' . $episode->updateDate();
	}
?>
					</i></p>
				</div>
<?php
}
?>
			</div>
			<div class="card-footer">
				<a href="#" class="btn btn-primary">Remonter</a>
			</div>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

