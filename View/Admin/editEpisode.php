<?php
$this->setTitle("Billet simple pour l'Alaska - Modification épisode");
$this->setJavascript(["editEpisode.js"]);
?>

<?php require('View/adminNav.php'); ?>
<form method="post" action="?controller=admin&amp;action=editEpisode&amp;episodeId=<?= $episodeId ?>">
	<h2>Modification de l'épisode</h2>
	<p class="text-danger"><?= $message ?></p>
	<div class="accordion" id="accordion">
		<div class="card">
			<div class="card-header" id="headingOne">
				<h2>
					<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expand="true" aria-controls="collapseOne">Données originales de l'épisode</button>
				</h2>
			</div>
			<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
				<div class="card-body">
					<div class="container-fluid">
						<div class="row text-center my-4">
							<h4 class="col-md-6">
								Episode n° <?= $episodeId ?>
							</h4>
							<h4 class="col-md-6">
								Titre : <?= $title ?>
							</h4>
						</div>
						<div>
							<?= $content ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group m-3">
		<label for="id">Episode n° : </label>
		<input type="text" name="id" id="id" class="form-control" placeholder="Ne remplir qu'en cas de changement de l'ordre des épisodes"/>
	</div>
	<div class="form-group m-3">
		<label for="title">Titre de l'épisode : </label>
		<input type="text" name="title" id="title" class="form-control" placeholder="Ne remplir qu'en cas de changement de titre"/>
	</div>
	<div class="form-group m-3">
		<label for="content">Texte : </label>
		<i class="form-text text-muted">Ne remplir qu'en cas de modification du texte</i>
		<textarea type="text" name="content" id="content" class="form-control" rows="30"/></textarea>
	</div>
	<div class="form-group m-3">
		<button type="submit" class="btn btn-primary">Sauvegarder</button>
	</div>
</form>
