<?php
$this->setTitle('Administration - Liste des épisodes');
$this->setJavascript(['listEpisodes.js']);

require('View/adminNav.php');
?>
<div class="container-fluid">
	<div class="d-flex justify-content-between m-3">
		<h3>Nombre total d'épisodes publiés : <?= $nb_episodes ?></h3>
		<a href="?controller=admin&amp;action=writeEpisode" class="btn btn-primary">Nouvel épisode</a>
	</div>
	<table class="table table-responsive-md table-striped text-center">
		<thead class="thead-dark">
			<tr>
				<th>Episode n°</th>
				<th>Titre de l'épisode</th>
				<th>Date de publication</th>
				<th>Date de la dernière mise à jour</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
<?php
foreach($episodesList as $episode)
{
?>
			<tr id="episode<?= $episode->id() ?>">
				<td><a href="?controller=episodes&amp;action=read&amp;id=<?= $episode->id() ?>"><?= $episode->id() ?></a></td>
				<td><?= $this->sanitize($episode->title()) ?></td>
				<td><?= $episode->postDate() ?></td>
				<td><?= $episode->updateDate() ?></td>
				<td><small><i>
					<a href="?controller=admin&amp;action=editEpisode&amp;episodeId=<?= $episode->id() ?>" class="text-primary">Modifier</a><br/>
					<a href="?controller=admin&amp;action=deleteEpisode&amp;id=<?= $episode->id() ?>" class="text-danger">Supprimer</a>
				</i></small></td>
			</tr>
<?php
}
?>
		</tbody>
	</table>
</div>
