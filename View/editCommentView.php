<?php
$title = 'Modification de commentaire';
//$script = '<script src="assets/js/episodes.js"></script>';?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<div class="container-fluid">
	<form>
		<p>Commentaire original :</p>
		<p><?= $comment->comment() ?></p>

		<textarea name="comment" rows="3" id="commentArea" class="form-control" placeholder="Ecrivez votre nouveau commentaire ici"></textarea>
		<button type="submit" id="submitComment" class="btn btn-success" disabled="disabled">Mettre à jour</button>
	</form>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

