<?php $title = "Confirmation d'inscription."; ?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<h1>Bienvenue !</h1>
<p>Votre inscription a bien été pris en compte.</p>
<ul>
	<li>Nom d'utilisateur : <?= $_POST['pseudo'] ?></li>
	<li>Mot de passe : <?= $_POST['password'] ?></li>
</ul>
<a href="." class="btn btn-primary">Page d'accueil</a>
<a href="episodes.php" class="btn btn-success">Liste des épisodes</a>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
