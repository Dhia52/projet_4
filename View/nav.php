<nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid fixed-top">
	<div class="container-fluid">
		<span class="navbar-brand">Billet simple pour l'Alaska</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav mx-auto">
					<a id="homeLink" class="nav-item nav-link" href=".">Accueil</a>
					<a id="episodesLink" class="nav-item nav-link" href="./?controller=episodes">Episodes</a>
					<a id="aboutLink" class="nav-item nav-link" href="about.php">A propos de l'auteur</a>
			</div>
			<form>
			<?php
			if(isset($_SESSION['id']))
			{
			?>
				<a id="profileButton" class="btn btn-primary" href="profile.php?id=<?= $_SESSION['id'] ?>"><?= $_SESSION['pseudo'] ?></a>
				<a id="logoutButton" class="btn btn-danger" href="?controller=sessions&amp;action=logout">Déconnexion</a>
			<?php
			}
			else
			{
			?>
				<a id="signInButton" class="btn btn-primary" href="?controller=sessions&amp;action=signIn">Inscription</a>
				<a id="loginButton" class="btn btn-success" href="?controller=sessions&amp;action=login">Connexion</a>
			<?php
			}
			?>
			</form>
		</div>
	</div>
</nav>
