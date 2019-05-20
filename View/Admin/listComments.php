<?php
$this->setTitle('Administration - Liste des commentaires');
$this->setJavascript(['listComments.js']);

require('View/adminNav.php');
?>
<!-- Bootstrap Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Commentaire</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>
<!------------------------------------------------->
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
	$trClass = '';
	$unreportLink = '';
	if($comment->reported())
	{
		$trClass = 'class="table-warning"';
		$unreportLink = '<a href=?controller=comments&action=report&id=' . $comment->id() . ' class="text-primary">Inoffensif</a>';
	}
?>
	<tr id="comment<?= $comment->id() ?>" <?= $trClass ?>>
			<td class="comment">
				<?= $this->sanitize($comment->truncate()) ?>
<?php
	if(strlen($comment->comment()) > 50)
	{
?>
	<button type="button" data-toggle="modal" data-target="#commentModal" data-comment="<?= $this->sanitize($comment->comment()) ?>">...</button>
<?php
	}
?>
				</td>
				<td><a href="?controller=admin&amp;action=listMembers#member<?= $comment->authorId() ?>"><?= $comment->authorId() ?></a></td>
				<td><a href="?controller=admin&amp;action=listEpisodes#episode<?= $comment->episodeId() ?>"><?= $comment->episodeId() ?></a></td>
				<td><?= $comment->commentDate() ?></td>
				<td><?= $comment->updateDate() ?></td>
				<td><small><i>
					<a href="?controller=comments&amp;action=delete&amp;id=<?= $comment->id() ?>" class="text-danger">Supprimer</a><br/>
				<?= $unreportLink ?>
				</i></small></td>
			</tr>
<?php
}
?>
		</tbody>
	</table>
</div>
