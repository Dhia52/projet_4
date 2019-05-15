<nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid fixed-top">
	<div class="container-fluid">
		<span class="navbar-brand"><a href="?controller=admin" class="text-light">Administration</a></span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav mx-auto">
					<a id="homeLink" class="nav-item nav-link" href=".">Accueil</a>
					<a id="episodesLink" class="nav-item nav-link" href="?controller=admin&amp;action=listEpisodes">Episodes</a>
					<a id="commentsLink" class="nav-item nav-link" href="?controller=admin&amp;action=listComments">Commentaires</a>
					<a id="membersLink" class="nav-item nav-link" href="?controller=admin&amp;action=listMembers">Membres</a>
			</div>
			<form>
				<a id="profileButton" class="btn btn-primary" href="?controller=members&amp;action=show&amp;id=<?= $_SESSION['id'] ?>"><?= $_SESSION['pseudo'] ?></a>
				<a id="logoutButton" class="btn btn-danger" href="?controller=sessions&amp;action=logout">Déconnexion</a>
			</form>
		</div>
	</div>
</nav>
