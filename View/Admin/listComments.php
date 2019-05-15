<?php
$this->setTitle('Administration - Liste des commentaires');
$this->setJavascript(['listComments.js']);

require('View/adminNav.php');
?>
<div class="container-fluid">
	<h3 class="m-3">Nombre de commentaires : <?= $nb_comments ?></h3>
	<table class="table table-responsive-md table-striped text-center">
		<thead class="thead-dark">
			<tr>
				<th>Commentaire</th>
				<th>Auteur</th>
				<th>Episode commenté</th>
				<th>Date de publication</th>
				<th>Date de dernière mise à jour</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
<?php
foreach($commentsList as $comment)
{
?>
			<tr id="comment<?= $comment->id() ?>">
				<td><?= $this->sanitize($comment->comment()) ?></td>
				<td><a href="?controller=admin&amp;action=listMembers#member<?= $comment->authorId() ?>"><?= $comment->authorId() ?></a></td>
				<td><a href="?controller=admin&amp;action=listEpisodes#episode<?= $comment->episodeId() ?>"><?= $comment->episodeId() ?></a></td>
				<td><?= $comment->commentDate() ?></td>
				<td><?= $comment->updateDate() ?></td>
				<td><small><i><a href="?controller=comments&amp;action=delete&amp;id=<?= $comment->id() ?>" class="text-danger">Supprimer</a></i></small></td>
			</tr>
<?php
}
?>
		</tbody>
	</table>
</div>
