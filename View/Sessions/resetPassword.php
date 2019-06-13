<?php
$this->setTitle("Réinitialisation de mot de passe");
//$this->setJavascript(["signIn.js"]);
?>

<?php require('View/nav.php'); ?>
<form method="post" action="?controller=sessions&amp;action=resetPassword">
	<h2>Réinitialisation de mot de passe</h2>
	<p class="text-danger"><?= $message ?></p>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="pseudo">Nom utilisateur : </label></div>
		<div class="col-sm-8">
		<input type="text" name="pseudo" id="pseudo" class="form-control" required/>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="email">Adresse e-mail : </label></div>
		<div class="col-sm-8">
			<input type="email" name="email" id="email" class="form-control" required/>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-12"><button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button></div>
	</div>
</form>
