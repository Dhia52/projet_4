<?php $title = "Confirmation d'inscription"; ?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<h1>Bienvenue !</h1>
<p>Votre inscription a bien été pris en compte.</p>
<ul>
	<li>Nom d'utilisateur : <?= $_POST['pseudo'] ?></li>
	<li>Mot de passe : <?= $_POST['password'] ?></li>
</ul>
<p>Votre page utilisateur est accessible en cliquant sur le bouton portant votre pseudo dans la barre de navigation.</p>
<a href="." class="btn btn-primary">Page d'accueil</a>
<a href="episodes.php" class="btn btn-success">Liste des épisodes</a>
<h2>Bonne lecture !</h2>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
