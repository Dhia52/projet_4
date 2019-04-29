<?php
$title = 'Commentaire publié';
//$script = '<script src="assets/js/episodes.js"></script>';?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<div class="container-fluid">
	<h3>Votre commentaire a bien été publié.</h3>
	<div class="row">
		<p class="col-md-4"><?= $_SESSION['pseudo'] ?></p>
		<p class="col-md-8"><?= $_POST['newComment'] ?></p>
	</div>
	<a href="episodes.php?id=<?= $_GET['id'] ?>" class="btn btn-primary">Retour à l'épisode <?= $_GET['id'] ?></a>
	<a href="episodes.php" class="btn btn-primary">Liste des épisodes</a>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

