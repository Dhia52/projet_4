<?php
$this->setTitle("Billet simple pour l'Alaska - Modification épisode");
$this->setJavascript(["editEpisode.js"]);
?>

<?php require('View/adminNav.php'); ?>
<form method="post" action="?controller=admin&amp;action=editEpisode&amp;episodeId=<?= $episodeId ?>">
	<h2>Modification de l'épisode</h2>
	<p class="text-danger"><?= $message ?></p>
	<div class="form-group m-3">
		<label for="id">Episode n° : </label>
		<input type="text" name="id" id="id" class="form-control" placeholder="Ne remplir qu'en cas de changement de l'ordre des épisodes" value="<?= $episodeId ?>"/>
	</div>
	<div class="form-group m-3">
		<label for="title">Titre de l'épisode : </label>
		<input type="text" name="title" id="title" class="form-control" placeholder="Ne remplir qu'en cas de changement de titre" value="<?= $title ?>"/>
	</div>
	<div class="form-group m-3">
		<label for="content">Texte : </label>
		<textarea type="text" name="content" id="content" class="form-control" rows="30"/><?= $content ?></textarea>
	</div>
	<div class="form-group m-3">
		<button type="submit" class="btn btn-primary">Sauvegarder</button>
	</div>
</form>
