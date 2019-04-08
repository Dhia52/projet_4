<?php $title = 'Déconnexion'; ?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<h3>Vous vous êtes déconnecté(e).</h3>
<a href="." class="btn btn-primary">Retour à la page d'accueil</a>
<a href="episodes.php" class="btn btn-success">Liste des épisodes</a>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
