<?php
$this->setTitle("Modification de profil");
$this->setJavascript(["memberEdit.js"]);
?>

<?php require('View/nav.php'); ?>
<form method="post" action="?controller=members&amp;action=edit&amp;id=<?= $member->id() ?>">
	<div class="m-3">
		<h2>Modification du compte</h2>
		<p class="text-success"><?= $confirmation ?></p>
		<p class="text-danger"><?= $message ?></p>
	</div>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="pseudo">Nom utilisateur : </label></div>
		<div class="col-sm-8">
		<input type="text" name="pseudo" id="pseudo" class="form-control" value="<?= $member->pseudo() ?>" <?= $pseudoDisabled ?>/>
		</div>
	</div>
<?php
if($_SESSION['id'] === (int) $_GET['id'])
{
?>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="email">Adresse e-mail : </label></div>
		<div class="col-sm-8">
		<input type="email" name="email" id="email" class="form-control" value="<?= $member->email() ?>"/>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="oldPassword">Ancien mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="oldPassword" id="oldPassword" class="form-control"/>
		</div>
		<div class="col-sm-4"><label for="newPassword">Nouveau mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="newPassword" id="newPassword" class="form-control"/>
		</div>
		<div class="col-sm-4"><label for="confirmPassword">Confirmer le nouveau mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="confirmPassword" id="confirmPassword" class="form-control"/>
		<small class="form-text text-muted">Ne remplir ces champs qu'en cas de changement de mot de passe</small>
			<small class="form-text text-muted">Le mot de passe doit contenir au moins 8 caractères.</small>
		</div>
	</div>
<?php
}
?>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="category">Grade : </label></div>
		<div class="col-sm-8">

			<select name="category" id="category" class="form-control" <?= $selectDisabled ?>/>
				<option value="Admin" <?= $selectOption1 ?>>Administrateur</option>
				<option value="Writer" <?= $selectOption2 ?>>Ecrivain</option>
				<option value="Mod" <?= $selectOption3 ?>>Modérateur</option>
				<option value="Reader" <?= $selectOption4 ?>>Lecteur</option>
			</select>
<?php
if(!\in_array($_SESSION['category'], ['Admin', 'Writer']))
{
?>
	<small class="form-text text-muted">Contactez l'administrateur du site pour modifier votre grade.</small>
<?php
}
?>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-12"><button type="submit" class="btn btn-primary">Sauvegarder</button></div>
	</div>
</form>
