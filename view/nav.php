<nav class="navbar navbar-expand-lg navbar-dark bg-dark container-fluid fixed-top">
	<div class="container-fluid">
		<span class="navbar-brand">Billet simple pour l'Alaska</span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav mx-auto">
					<a class="nav-item nav-link active" href=".">Accueil</a>
					<a class="nav-item nav-link" href="episodes.php">Episodes</a>
					<a class="nav-item nav-link" href="about.php">A propos de l'auteur</a>
			</div>
			<form>
			<?php
			if(isset($_SESSION['id']))
			{
			?>
				<a class="btn btn-primary" href="profile.php?id=<?= $sessionMember->id() ?>"><?= $sessionMember->pseudo() ?></a>
				<a class="btn btn-danger" href="form.php?logout">Déconnexion</a>
			<?php
			}
			else
			{
			?>
				<a class="btn btn-primary" href="form.php?signIn">Inscription</a>
				<a class="btn btn-success" href="form.php?login">Connexion</a>
			<?php
			}
			?>
			</form>
		</div>
	</div>
</nav>
