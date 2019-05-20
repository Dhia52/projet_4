<?php
$this->setTitle("Billet simple pour l'Alaska - Modification épisode");
$this->setJavascript(["writeEpisode.js"]);
?>

<?php require('View/adminNav.php'); ?>
<form method="post" action="?controller=admin&amp;action=editEpisode">
	<h2>Modification de l'épisode</h2>
	<div class="">
	</div>
	<div class="form-group m-3">
		<label for="title">Episode n° : </label>
		<input type="text" name="title" id="title" class="form-control" placeholder="Ne remplir qu'en cas de changement de l'ordre des épisodes"/>
	</div>
	<div class="form-group m-3">
		<label for="title">Titre de l'épisode : </label>
		<input type="text" name="title" id="title" class="form-control" placeholder="Ne remplir qu'en cas de changement de titre"/>
	</div>
	<div class="form-group m-3">
		<label for="episodeContent">Texte : </label>
		<i class="form-text text-muted">Ne remplir qu'en cas de modification du texte</i>
		<textarea type="text" name="episodeContent" id="episodeContent" class="form-control" rows="30"/></textarea>
	</div>
	<div class="form-group m-3">
		<button type="submit" class="btn btn-primary">Sauvegarder</button>
	</div>
</form>
