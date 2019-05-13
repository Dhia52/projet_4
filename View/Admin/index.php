<?php
$this->setTitle('Administration');

require('View/adminNav.php');
?>
<div class="container-fluid">
	<div class="card-deck">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Episodes</h4>
				<div class="card-text">
					<p>Episodes publiés : <?= $nb_episodes ?></p>
					<ul>
						<li><a href="?controller=admin&amp;action=listEpisodes">Liste des épisodes</a></li>
						<li><a href="?controller=admin&amp;action=writeEpisode">Nouvel épisode</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Membres</h4>
				<div class="card-text">
					<p>Membres inscrits : <?= $nb_members ?></p>
					<ul>
						<li><a href="?controller=admin&amp;action=listMembers">Liste des membres</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Commentaires</h4>
				<div class="card-text">
					<p>Nombre de commentaires : <?= $nb_comments ?></p>
					<ul>
						<li><a href="?controller=admin&amp;action=listComments">Liste des commentaires</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
