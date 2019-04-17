<?php

function loadClass($class)
{
	require('model/' . $class . '.php');
}

spl_autoload_register('loadClass');

$episodeManager = new PDO_EpisodeManager(DBFactory::setPDO());
$memberManager = new PDO_MemberManager(DBFactory::setPDO());
$commentManager = new PDO_CommentManager(DBFactory::setPDO());
/*
$episodeManager = new MySQLi_EpisodeManager(DBFactory::setMySQLi());
$memberManager = new MySQLi_MemberManager(DBFactory::setMySQLi());
$commentManager = new MySQLi_CommentManager(DBFactory::setMySQLi());
 */
function homepage($episodeManager)
{
	$list = $episodeManager->getList(6);
	require('view/home.php');
}

function displaySignInForm()
{
	$action = 'signIn';
	$headerText = "Formulaire d'inscription";
	$buttonText = "S'inscrire";
	require('view/form.php');
}

function displayLoginForm()
{
	$action = 'login';
	$headerText = 'Connexion';
	$buttonText = 'Se connecter';
	require('view/form.php');
}

function createNewMember(MemberManager $memberManager, $pseudo, $password)
{
	if ($memberManager->exists($pseudo))
	{
		$duplicateUsernameMessage = "Ce nom d'utilisateur est déjà utilisé.";
		$action = 'signIn';
		$headerText = "Formulaire d'inscription";
		$buttonText = "S'inscrire";
		require('view/form.php');
	}
	else
	{
		$member = new Member(array(
			'pseudo' => $pseudo,
			'password' => password_hash($password, PASSWORD_DEFAULT)
		));
		$memberManager->create($member);
		$member = $memberManager->getMember($pseudo);
		$_SESSION['id'] = $member->id();
		$_SESSION['pseudo'] = $member->pseudo();
		require('view/confirmSignIn.php');
	}
}

function login(MemberManager $memberManager, $pseudo, $password)
{
	if ($memberManager->exists($pseudo))
	{
		$member = $memberManager->getMember($pseudo);
		if(password_verify($password, $member->password()))
		{
			$_SESSION['id'] = $member->id();
			$_SESSION['pseudo'] = $member->pseudo();
			$memberManager->update($member->id(), array('lastConnexion' => ''));
			header('Location: .');
		}
		else
		{
			$message = 'Mot de passe incorrect';
		}
	}
	else
	{
		$message = 'Compte introuvable';
	}
	
	$action = 'login';
	$headerText = 'Connexion';
	$buttonText = 'Se connecter';
	require('view/form.php');
}

function logout()
{
	if(isset($_SESSION['id']))
	{
		session_destroy();
	}
	
	header('Location: .');
}

function displayProfile(MemberManager $memberManager, CommentManager $commentManager, $id)
{
	if($memberManager->exists($id))
	{
		$member = $memberManager->getMember($id);
		$nb_comments = $commentManager->count($id, 'member');
		$nb_comments = $nb_comments['Comments'];
		$list = $commentManager->getList($id, 'member');
		require('view/user.php');
	}
	else
	{
		throw new Exception('User account does not exist.');
	}
}

function episodesList(EpisodeManager $episodeManager)
{
	$list = $episodeManager->getList();
	require('view/episodesList.php');
}

function episode(EpisodeManager $episodeManager, CommentManager $commentManager, int $id)
{
	$commentsList = $commentManager->getList($id, 'episode');
	$episode = $episodeManager->getEpisode($id);

	if($episodeManager->exists($id - 1))
	{
		$prevDisable = '';
	}
	else
	{
		$prevDisable = ' disabled';
	}

	if($episodeManager->exists($id + 1))
	{
		$nextDisable = '';
	}
	else
	{
		$nextDisable = ' disabled';
	}

	require('view/episodeView.php');
}

function postComment(CommentManager $commentManager, $episodeId, $authorId, $text)
{
	$newComment = new Comment(array(
		"episodeId" => $episodeId,
		"authorId" => $authorId,
		"comment" => $text
	));

	$commentManager->post($newComment);
	require('view/postComment.php');
}

function editComment(CommentManager $commentManager, $id)
{
	$comment = $commentManager->getComment($id);
	if($_SESSION['id'] === $comment->authorId())
	{
		require('view/editCommentView.php');
	}
	else
	{
		header('Location: episodes.php?id=' . $comment->authorId() . '&action=read');
	}
}
