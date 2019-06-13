<?php
$this->setTitle("Billet simple pour l'Alaska - Connexion");
$this->setJavascript(['form.js', 'login.js']);
?>

<?php require('View/nav.php'); ?>
<form method="post" action="?controller=sessions&amp;action=login">
	<h2>Connexion</h2>
	<p class="text-danger"><?= $message ?></p>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="pseudo">Nom utilisateur : </label></div>
		<div class="col-sm-8">
			<input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $pseudo ?>" required/>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="password">Mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="password" id="password" class="form-control" required/>
			<small class="form-text"><a href="?controller=sessions&amp;action=resetPassword">Mot de passe oublié</a></small>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-12"><button type="submit" class="btn btn-primary" disabled="disabled">Se connecter</button></div>
	</div>
</form>
