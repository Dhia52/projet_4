<?php

function loadClass($class)
{
	require('model/' . $class . '.php');
}

spl_autoload_register('loadClass');

$episodeManager = new PDO_EpisodeManager(DBFactory::setPDO()); 
$memberManager = new PDO_MemberManager(DBFactory::setPDO());

/*$episodeManager = new MySQLi_EpisodeManager(DBFactory::setMySQLi());
$memberManager = new MySQLi_MemberManager(DBFactory::setMySQLi());*/


function homepage($episodeManager, $memberManager)
{
	$list = $episodeManager->getList(6);
	if(isset($_SESSION['id']))
	{
		$sessionMember = $memberManager->getMember($_SESSION['id']);
	}
	require('view/home.php');
}

function displaySignInForm()
{
	require('view/signIn.php');
}

function createNewMember(MemberManager $memberManager, $pseudo, $password)
{
	if ($memberManager->exists($pseudo))
	{
		$duplicateUsernameMessage = "Ce nom d'utilisateur est déjà utilisé.";
		require('view/signIn.php');
	}
	else
	{
		$member = new Member(array(
			'pseudo' => $pseudo,
			'pass' => password_hash($password, PASSWORD_DEFAULT)
		));
		$memberManager->create($member);
		$member = $memberManager->getMember($pseudo);
		$_SESSION['id'] = $member->id();
		require('view/confirmSignIn.php');
	}
}

function logout()
{
	session_destroy();
	require('view/logout.php');
}
