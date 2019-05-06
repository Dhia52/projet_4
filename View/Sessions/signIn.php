<?php
$this->setTitle("Billet simple pour l'Alaska - Inscription");
$this->setJavascript(["signIn.js"]);
?>

<?php require('View/nav.php'); ?>
<form method="post" action="?controller=sessions&amp;action=signIn">
	<h2>Formulaire d'inscription</h2>
	<p class="text-danger"><?= $message ?></p>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="pseudo">Nom utilisateur : </label></div>
		<div class="col-sm-8">
		<input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $pseudo ?>"/>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="password">Mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="password" id="password" class="form-control"/>
			<small class="form-text text-muted">Le mot de passe doit contenir au moins 8 caractères.</small>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="confirmPassword">Confirmer le mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="confirmPassword" id="confirmPassword" class="form-control"/>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-12"><button type="submit" class="btn btn-primary" disabled="disabled">S'inscrire</button></div>
	</div>
</form>
