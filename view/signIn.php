<?php
$title = "Inscription";
$script = '<script src="assets/js/form.js"></script>';
?>

<?php ob_start() ?>
<?php require('view/nav.php'); ?>
<form method="post" action="form.php?signIn">
	<h2>Formulaire d'inscription</h2>
	<div class="form-row m-3">
		<div class="col-sm-4"><label for="pseudo">Nom utilisateur : </label></div>
		<div class="col-sm-8">
		<input type="text" name="pseudo" id="pseudo" class="form-control" <?php if(isset($_POST['pseudo'])) {echo 'value="' . $_POST['pseudo'] .'"';}?>/>
			<small class="text-danger" id="duplicateUsernameMessage"><?php if(isset($duplicateUsernameMessage)) {echo $duplicateUsernameMessage;} ?></small>
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
		<div class="col-12"><button type="submit" class="btn btn-primary" disabled="disabled">S'inscrire</button></div>
	</div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

