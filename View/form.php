<?php
$title = "Inscription";
if($_GET['action'] === 'login')
{
	$script = '<script src="assets/js/login.js"></script>';
}
elseif($_GET['action'] == 'signIn')
{
	$script = '<script src="assets/js/signIn.js"></script>';
}

$script .= '<script src="assets/js/form.js"></script>';
?>

<?php ob_start() ?>
<?php require('view/nav.php'); ?>
<form method="post" action="sessions.php?action=<?= $action ?>">
	<h2><?= $headerText ?></h2>
	<p class="text-danger"><?php if(isset($message)){echo $message;}?></p>
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
	<div class="col-12"><button type="submit" class="btn btn-primary" disabled="disabled"><?= $buttonText ?></button></div>
	</div>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
