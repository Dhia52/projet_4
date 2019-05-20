<?php
$this->setTitle("Billet simple pour l'Alaska - Nouvel épisode");
$this->setJavascript(["writeEpisode.js"]);
?>

<?php require('View/adminNav.php'); ?>
<form method="post" action="?controller=admin&amp;action=writeEpisode">
	<h2>Nouvel épisode</h2>
	<div class="form-row m-3">
		<div class="col-lg-4"><label for="title">Titre de l'épisode : </label></div>
		<div class="col-lg-8">
		<input type="text" name="title" id="title" class="form-control"/>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-lg-4"><label for="episodeContent">Texte : </label></div>
		<div class="col-lg-8">
			<textarea type="text" name="episodeContent" id="episodeContent" class="form-control" rows="30"/></textarea>
		</div>
	</div>
	<div class="form-row m-3">
		<div class="col-12"><button type="submit" class="btn btn-primary" disabled="disabled">Publier</button></div>
	</div>
</form>
