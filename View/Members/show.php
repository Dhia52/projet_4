<?php 
$this->setTitle("Profil de " . $this->sanitize($member->pseudo())); ?>

<?php require('View/nav.php'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-3">
			<div class="nav flex-column nav-pills border-right border-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      				<a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profil</a>
				<a class="nav-link" id="v-pills-comments-tab" data-toggle="pill" href="#v-pills-comments" role="tab" aria-controls="v-pills-comments" aria-selected="false">Commentaires</a>
<?php
if(isset($_SESSION['id']) && $_SESSION['id'] === $member->id())
{
?>
     	 			<a class="nav-link" id="v-pills-edit-tab" data-toggle="pill" href="#v-pills-edit" role="tab" aria-controls="v-pills-edit" aria-selected="false">Modifier</a>
				<a class="nav-link" id="v-pills-deleteAccount-tab" data-toggle="pill" href="#v-pills-deleteAccount" role="tab" aria-controls="v-pills-deleteAccount" aria-selected="false">Supprimer le compte</a>
<?php
}
?>
    			</div>
		</div>
		<div class="col-9">
			<div class="tab-content" id="v-pills-tabContent">
<!-- Main info -->
				<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
					<table class="table table-responsive table-striped">
						<tbody>
							<tr>
								<td>Nom d'utilisateur :</td>
								<td><?= $this->sanitize($member->pseudo()) ?></td>
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
				</div>
<!------------------------------------------------------------>
<!-- User comments -->
				<div class="tab-pane fade" id="v-pills-comments" role="tabpanel" aria-labelledby="v-comments-tab">
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
		<td class="col-md-4">
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
		<td class="col-md-8">
			<div class="row">
				<p class="col-8">
					<?= $this->sanitize($comment->comment()) ?>
				</p>
				<div class="col-4 text-right">
					<small><i>
<?php
if(isset($_SESSION['id']))
{
	if($_SESSION['id'] === $member->id())
	{
?>
	<a href="?controller=comments&amp;action=edit&amp;id=<?= $comment->id() ?>">Modifier</a><br>
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
					</i></small>
				</div>
			</div>
		</td>
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
<!-- Member edit form -->
				<div class="tab-pane fade" id="v-pills-edit" role="tabpanel" aria-labelledby="v-edit-tab">
					<form method="post" action="?controller=members&amp;action=edit&amp;id=<?= $_GET['id'] ?>">
					</form>
				</div>
<!---------------------------------------------------->
<!-- Delete account -->
				<div class="tab-pane fade" id="v-pills-deleteAccount" role="tabpanel" aria-labelledby="v-deleteAccount-tab">
					<h1>Suppression de compte</h1>
					<h3 class="text-danger">Attention ! Cette action est irréversible.</h3>
					<div>
						<a id="deleteButton" class="btn btn-danger" href="?controller=members&amp;action=delete&amp;id=<?= $_GET['id'] ?>">Supprimer le compte</a>
					</div>
				</div>
<!------------------------------------------------>
<?php
}
?>			</div>
		</div>
	</div>
</div>
