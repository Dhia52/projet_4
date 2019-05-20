<?php
$this->setTitle("Billet simple pour l'Alaska - Nouvel épisode");
$this->setJavascript(["writeEpisode.js"]);
?>

<?php require('View/adminNav.php'); ?>
<form method="post" action="?controller=admin&amp;action=writeEpisode">
	<h2>Nouvel épisode</h2>
	<div class="form-group m-3">
		<label for="title">Titre de l'épisode : </label>
		<input type="text" name="title" id="title" class="form-control"/>
	</div>
	<div class="form-group m-3">
		<label for="episodeContent">Texte : </label>
		<textarea type="text" name="episodeContent" id="episodeContent" class="form-control" rows="30"/></textarea>
	</div>
	<div class="form-group m-3">
		<button type="submit" class="btn btn-primary">Publier</button>
	</div>
</form>
