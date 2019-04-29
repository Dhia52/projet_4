<?php $title = "Profil de " . $member->pseudo(); ?>

<?php ob_start(); ?>
<?php require('view/nav.php'); ?>
<table class="table table-responsive table-striped">
	<tbody>
		<tr>
			<td>Nom d'utilisateur :</td>
			<td><?= $member->pseudo() ?></td>
		</tr>
		<tr>
			<td>Inscription le :</td>
			<td><?= $member->signDate() ?></td>
		</tr>
		<tr>
			<td>Dernière connexion le :</td>
			<td><?= $member->lastConnexion() ?></td>
		</tr>
		<tr>
			<td>Nombre de commentaires :</td>
			<td><?= $nb_comments ?></td>
		</tr>
	</tbody>
</table>

<?php
if(isset($_SESSION['id']))
{
	if($_SESSION['id'] === $member->id())
	{
?>
	<a href="profile.php?id=<?= $member->id() ?>&amp;action=edit" class="btn btn-primary">Modifier</a><a href="profile.php?id=<?= $member->id() ?>&amp;action=delete" class="btn btn-danger">Supprimer le compte</a>
<?php
	}
}
?>

<table class="table table-striped table-borderless card">
	<thead class="card-header">
		<tr>
			<th>Commentaires :</th>
		</tr>
	</thead>
	<tbody class="container-fluid card-body">
<?php
foreach($list as $comment)
{
?>
		<tr class="row d-flex align-items-center card-text">
		<td class="col-md-4"><a href="episodes.php?id=<?= $comment->episodeId() ?>">Episode <?= $comment->episodeId() ?></a></br><small><i>Le <?= $comment->commentDate() ?></br>
<?php
if(NULL !== $comment->updateDate())
{
?>			Màj le : <?= $comment->updateDate() ?></br>
<?php
}
if(isset($_SESSION['id']))
{
	if($_SESSION['id'] === $member->id())
	{
?>
	<a href="episodes.php?id=<?= $comment->id() ?>&amp;action=edit&amp;item=comment">Modifier</a>/<a href="episodes.php?id=<?= $comment->id() ?>&amp;action=delete&amp;item=comment" class="text-danger">Supprimer</a>
<?php
	}
	else
	{
?>
	<a href="episodes.php?id=<?= $comment->id() ?>&amp;action=report" class="text-danger">Signaler</a>
<?php
	}
}
?>
</td>
		<td class="col-md-8"><?= $comment->comment() ?></td>
		</tr>
<?php
}
?>
	</tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
