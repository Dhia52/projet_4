<?php
$this->setTitle("Billet simple pour l'Alaska - Modification de commentaire");
$this->setJavascript(['editComment.js']);
?>

<?php require('View/nav.php'); ?>
<form method="post" action="?controller=comments&amp;action=edit&amp;id=<?= $_GET['id'] ?>">
	<h2>Modification de commentaire</h2>
	<div class="form-row m-3">
	<h4><a href="?controller=episodes&amp;action=read&amp;id=<?= $comment->episodeId() ?>">Episode n°<?= $comment->episodeId() ?></a></h4>
	</div>
	<div class="form-row m-3">
		<h4>Commentaire original</h4>
	</div>
	<div class="form-row m-3">
		<p><?= $comment->comment() ?></p>
		<textarea name="comment" rows="3" id="comment" class="form-control" placeholder="Ecrivez votre nouveau commentaire ici"></textarea>
	</div>
	<div class="form-row m-3">
		<div class="col-12"><button id="submitComment" type="submit" class="btn btn-primary" disabled="disabled">Enregistrer</button></div>
	</div>
</form>
