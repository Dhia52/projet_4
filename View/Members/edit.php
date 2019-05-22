<?php
$this->setTitle("Modification de profil");
$this->setJavascript(["memberEdit.js"]);
?>

<?php require('View/nav.php'); ?>
<form method="post" action="?controller=members&amp;action=edit&amp;id=<?= $member->id() ?>">
	<div class="form-row m-3">
		<h2>Modification du compte</h2>
		<p class="text-danger"><?= $message ?></p>
	</div>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="pseudo">Nom utilisateur : </label></div>
		<div class="col-sm-8">
		<input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Ne remplir ce champ qu'en cas de changement de nom d'utilisateur"/>
		</div>
	</div>
<?php
if($_SESSION['id'] === (int) $_GET['id'])
{
?>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="password">Ancien mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="password" id="password" class="form-control"/>
		</div>
		<div class="col-sm-4"><label for="password">Nouveau mot de passe : </label></div>
		<div class="col-sm-8">
			<input type="password" name="password" id="password" class="form-control"/>
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
		<div class="col-sm-4"><label for="pseudo">Grade : </label></div>
		<div class="col-sm-8">
<?php
if(\in_array($_SESSION['category'], ['Admin', 'Writer']))
{
?>
	<input type="text" name="pseudo" id="pseudo" class="form-control" placeholder="Ne remplir ce champ qu'en cas de changement de grade"/>
<?php
}
else
{
?>
	<?= $member->category() ?><br/>
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
