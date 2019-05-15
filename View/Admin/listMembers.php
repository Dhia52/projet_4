<?php
$this->setTitle('Administration - Liste des membres');
$this->setJavascript(['listMembers.js']);

require('View/adminNav.php');
?>
<div class="container-fluid">
	<h3 class="m-3">Membres inscrits : <?= $nb_members ?></h3>
	<table class="table table-responsive-md table-striped text-center">
		<thead class="thead-dark">
			<tr>
				<th>ID</th>
				<th>Nom d'utilisateur</th>
				<th>Catégorie</th>
				<th>Date d'inscription</th>
				<th>Date de dernière connexion</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
<?php
foreach($membersList as $member)
{
?>
			<tr id="member<?= $member->id() ?>">
				<td><a href="?controller=members&amp;action=show&amp;id=<?= $member->id() ?>"><?= $member->id() ?></a></td>
				<td><?= $this->sanitize($member->pseudo()) ?></td>
				<td><?= $member->category() ?></td>
				<td><?= $member->signDate() ?></td>
				<td><?= $member->lastConnexion() ?></td>
				<td><small><i>
					<a href="?controller=admin&amp;action=editMember&amp;id=<?= $member->id() ?>" class="text-primary">Modifier</a><br/>
					<a href="?controller=members&amp;action=delete&amp;id=<?= $member->id() ?>" class="text-danger">Bannir</a>
				</i></small></td>
			</tr>
<?php
}
?>
		</tbody>
	</table>
</div>
