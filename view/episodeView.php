<?php
$title = $episode->title();
//$script = '<script src="assets/js/episodes.js"></script>';?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<div class="container-fluid">
	<div class="card">
	<h1 class="card-header"><?= $episode->title() ?></h1>
		<div class="card-body">
			<p class="card-text"><?= $episode->content() ?></p>
		</div>
		<div class="card-footer">
			<h3>Commentaires</h3>
<?php
if(isset($_SESSION['id']))
{
	if(empty($commentsList))
	{
?>
		<p>Soyez la première personne à laisser votre avis sur cet épisode !</p>
<?php
	}
?>
	<form action="episodes.php?id=<?= $episode->id() ?>" method="post">
		<input type="text" name="comment" id="newComment" class="form-control" placeholder="Ecrivez votre commentaire ici"/>
		<button type="submit" class="btn btn-success" disabled="disabled">Commenter</button>
	</form>
<?php
}
else
{
?>
	<p>Connectez-vous pour laisser votre avis. <a href="session.php?action=login" class="btn btn-success">Se connecter</a></p>
	<p>Vous n'avez pas encore de compte ? Inscrivez-vous !
	<a href="session.php?action=signIn" class="btn btn-primary">S'inscrire</a></p>
<?php
}
?>
			<table class="table">
				<tbody>
<?php
foreach ($commentsList as $comment)
{
?>
					<tr class="row">
						<td class="col-md-2"><?= $comment->commenter() ?></td>
						<td class="col-md-10"><?= $comment->comment() ?></td>
					</tr>
<?php
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>

