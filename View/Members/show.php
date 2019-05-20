<?php 
$this->setTitle("Profil de " . $this->sanitize($member->pseudo())); ?>

<?php require('View/nav.php'); ?>
<div class="container-fluid">
	<nav class="my-3">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
      			<a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Profil</a>
			<a class="nav-item nav-link" id="nav-comments-tab" data-toggle="tab" href="#nav-comments" role="tab" aria-controls="nav-comments" aria-selected="false">Commentaires</a>
<?php
if(isset($_SESSION['id']) && $_SESSION['id'] === $member->id())
{
?>
			<a class="nav-item nav-link" id="nav-deleteAccount-tab" data-toggle="tab" href="#nav-deleteAccount" role="tab" aria-controls="nav-deleteAccount" aria-selected="false">Supprimer le compte</a>
<?php
}
?>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
<!-- Main info -->
		<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<table class="table table-responsive-sm table-striped">
				<tbody>
					<tr>
						<td>Nom d'utilisateur :</td>
						<td><?= $this->sanitize($member->pseudo()) ?></td>
					</tr>
					<tr>
						<td>Grade :</td>
						<td><?= $this->sanitize($member->category()) ?></td>
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
if(isset($_SESSION['id']) && $_SESSION['id'] === $member->id())
{
?>
	<a href="?controller=members&amp;action=edit&amp;id=<?= $member->id() ?>" class="btn btn-primary">Modifier mon profil</a>
<?php
}
?>
		</div>
<!------------------------------------------------------------>
<!-- User comments -->
		<div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="nav-comments-tab">
			<table class="table table-striped table-borderless">
				<tbody class="container-fluid">
<?php
foreach($list as $comment)
{
?>
					<tr class="row d-flex align-items-center">
						<td class="col-md-3">
							<a href="?controller=episodes&amp;action=read&amp;id=<?= $comment->episodeId() ?>">Episode <?= $comment->episodeId() ?></a><br>
							<small><i>Le <?= $comment->commentDate() ?><br>
<?php
if(NULL !== $comment->updateDate())
{
?>
								Màj le : <?= $comment->updateDate() ?><br>
<?php
}
?>
							</i></small>
						</td>
						<td class="<?= $commentTdClass ?>"><?= $this->sanitize($comment->comment()) ?></td>
<?php
if(isset($_SESSION['id']))
{
?>
						<td class="<?= $extraTdClass ?>"><small><i>
<?php
	if($_SESSION['id'] === $member->id())
	{
?>							<a href="?controller=comments&amp;action=edit&amp;id=<?= $comment->id() ?>">Modifier</a><br>
							<a href="?controller=comments&amp;action=delete&amp;id=<?= $comment->id() ?>" class="text-danger">Supprimer</a>
<?php
	}
	else
	{
?>
							<a href="?controller=comments&amp;action=report&amp;id=<?= $comment->id() ?>" class="text-danger">Signaler</a>
<?php
	}
}
?>
						</i></small></td>
					</tr>
<?php
}
?>
				</tbody>
			</table>
		</div>
<!------------------------------------------------>
<?php
if(isset($_SESSION['id']) && $_SESSION['id'] === $member->id())
{
?>
<!-- Delete account -->
		<div class="tab-pane fade" id="nav-deleteAccount" role="tabpanel" aria-labelledby="nav-deleteAccount-tab">
			<h3 class="text-danger">Attention ! Cette action est irréversible.</h3>
			<div>
				<a id="deleteButton" class="btn btn-danger" href="?controller=members&amp;action=delete&amp;id=<?= $_GET['id'] ?>">Je suis sûr(e) de vouloir supprimer mon compte</a>
			</div>
		</div>
<!------------------------------------------------>
<?php
}
?>
	</div>
</div>
