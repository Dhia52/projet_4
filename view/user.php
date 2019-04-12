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
			<td></td>
		</tr>
		<tr>
			<td>Derniers commentaires :</td>
			<td></td>
		</tr>
	</tbody>
</table>

<?php
if(isset($_SESSION['id']))
{
	if($_SESSION['id'] === $member->id())
	{
?>
	<a href="profile.php?id=<?= $member->id() ?>&amp;edit" class="btn btn-primary">Modifier</a>
<?php
	}
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
