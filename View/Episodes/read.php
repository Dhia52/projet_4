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
			<p class="card-text"><?= $episode->content() ?></p>
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
	<form action="?controller=comments&amp;action=post&amp;id=<?= $episode->id() ?>" method="post" class="my-3">
		<textarea name="newComment" rows="3" id="commentArea" class="form-control" placeholder="Ecrivez votre commentaire ici"></textarea>
		<button type="submit" id="submitComment" class="btn btn-success mt-2" disabled="disabled">Commenter</button>
	</form>
<?php
}
else
{
?>
	<div class="row text-center">
		<p class="col-6">Connectez-vous pour laisser votre avis.</br><a href="?controller=sessions&amp;action=login" class="btn btn-success">Se connecter</a></p>
		<p class="col-6">Vous n'avez pas encore de compte ? Inscrivez-vous !</br><a href="?controller=sessions&amp;action=signIn" class="btn btn-primary">S'inscrire</a></p>
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
<tr class="row d-flex align-items-center border-bottom border-dark">
<?php
	if($comment->reported())
	{
?>
		<td class="col-12 table-danger text-center">Ce commentaire a été signalé</td>
<?php
	}
	else
	{
?>
		<td class="col-md-3"><a href="?controller=members&amp;action=show&amp;id=<?= $comment->authorId() ?>"><?= $comment->author() ?></a></br><small><i>Le <?=$comment->commentDate() ?></br>
<?php
		if(NULL !== $comment->updateDate())
		{
?>
			Màj le : <?= $comment->updateDate() ?></br>
<?php
		}
?>
		</i></small>
		</td>
		<td class="<?= $commentTdClass ?>">
			<?= $comment->comment(); ?>	
		</td>
<?php
		if(isset($_SESSION['id']))
		{
?>
			<td class="<?= $extraTdClass ?>"><small><i>
<?php
			if($_SESSION['id'] === $comment->authorId())
			{
?>
				<a href="?controller=comments&amp;action=edit&amp;id=<?= $comment->id() ?>" class="text-primary">Modifier</a><br/>
				<a href="?controller=comments&amp;action=delete&amp;id=<?= $comment->id() ?>" class="text-danger">Supprimer</a>
<?php
			}
			else
			{
?>
				<a href="?controller=comments&amp;action=report&amp;id=<?= $comment->id() ?>" class="text-danger">Signaler</a>
<?php
			}
?>
			</i></small></td>
<?php
		}
	}
?>
</tr>
<?php
}
?>
				</tbody>
			</table>
		</div>
	</div>
</div>
