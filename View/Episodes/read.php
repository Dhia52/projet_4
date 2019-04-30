<?php
$this->setTitle($this->sanitize($episode->title()));
$this->setJavascript(['episodes.js']);?>

<?php require('View/nav.php'); ?>
<nav class="navbar">
	<a href="?controller=episodes&amp;action=read&amp;id=<?= $_GET['id']-1 ?>" class="btn btn-danger<?= $prevDisable ?>"><i class="fas fa-arrow-alt-circle-left"></i> Episode précédent</a>
	<a href="?controller=episodes" class="btn btn-primary">Liste des épisodes</a>
	<a href="?controller=episodes&amp;action=read&amp;id=<?= $_GET['id']+1 ?>" class="btn btn-success<?= $nextDisable ?>">Episode suivant <i class="fas fa-arrow-alt-circle-right"></i></a>
</nav>
<div class="container-fluid">
	<div class="card">
	<h1 class="card-header"><?= $this->sanitize($episode->title()) ?></h1>
		<div class="card-body">
			<p class="card-text"><?= $this->sanitize($episode->content()) ?></p>
		</div>
		<div class="card-footer">
			<h3>Commentaires</h3>
<?php
if(isset($_SESSION['id']))
{
	if(empty($comments))
	{
?>
		<p>Soyez la première personne à laisser votre avis sur cet épisode !</p>
<?php
	}
?>
	<form action="episodes.php?id=<?= $episode->id() ?>" method="post">
		<textarea name="newComment" rows="3" id="commentArea" class="form-control" placeholder="Ecrivez votre commentaire ici"></textarea>
		<button type="submit" id="submitComment" class="btn btn-success" disabled="disabled">Commenter</button>
	</form>
<?php
}
else
{
?>
	<div class="row text-center">
		<p class="col-6">Connectez-vous pour laisser votre avis.</br><a href="sessions.php?action=login" class="btn btn-success">Se connecter</a></p>
		<p class="col-6">Vous n'avez pas encore de compte ? Inscrivez-vous !</br><a href="sessions.php?action=signIn" class="btn btn-primary">S'inscrire</a></p>
	</div>
<?php
}
?>
			<table class="table table-striped table-borderless">
				<tbody>
<?php
foreach ($comments as $comment)
{
?>
<tr class="row d-flex align-items-center">
	<td class="col-md-4"><a href="profile.php?id=<?= $comment->authorId() ?>"><?= $comment->author() ?></a></br><small><i>Le <?=$comment->commentDate() ?></br>
<?php
if(NULL !== $comment->updateDate())
{
?>
		Màj le : <?= $comment->updateDate() ?></br>
<?php
}
?>
		...</i></small>
	</td>
	<td class="col-md-8">
		<p class="mb-0"><?= $comment->comment() ?></p>
		<p class="mb-0 text-right"><i><small>
<?php
if(isset($_SESSION['id']))
{
	if($_SESSION['id'] === $comment->authorId())
	{
?>
	<a href="" class="edit">Modifier</a>/<a href="" class="text-danger delete">Supprimer</a>
<?php
	}
	else
	{
?>
	<a href="" class="text-danger">Signaler</a>
<?php
	}
}
?>
		</i></small></p>
	</td>
</tr>
<?php
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
