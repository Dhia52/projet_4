<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model\Classes\Member;
use projets_developpeur_web\projet_4\Model as Model;
use projets_developpeur_web\projet_4\Framework as Framework;
use projets_developpeur_web\projet_4 as project;


class SessionsController extends Framework\Controller
{
	protected $memberManager;

	public function __construct()
	{
		$this->memberManager = Managers\Manager::setManager('MemberManager', Framework\Configuration::get('DB_API'));
	}

	public function signIn()
	{
		$message = '';
		$pseudo = '';

		if(isset($_POST['pseudo']) && isset($_POST['password']))
		{
			$pseudo = $_POST['pseudo'];
			if($this->memberManager->exists($pseudo))
			{
				$message = "Ce nom d'utilisateur est indisponible.";
			}
			else
			{
				$member = new Member(array(
					'pseudo' => $pseudo,
					'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)));
				$this->memberManager->create($member);
				$member = $this->memberManager->getMember($pseudo);
				$_SESSION['id'] = $member->id();
				$_SESSION['pseudo'] = $member->pseudo();
				header('Location: .');
			}
		}
		$this->createView(array(
			'message' => $message,
			'pseudo' => $pseudo));
	}

	public function login()
	{
		$message = '';
		$pseudo = '';

		if(isset($_POST['pseudo']) && isset($_POST['password']))
		{
			$pseudo = $_POST['pseudo'];
			if($this->memberManager->exists($pseudo))
			{
				$member = $this->memberManager->getMember($pseudo);
				if(password_verify($_POST['password'], $member->password()))
				{
					$_SESSION['id'] = $member->id();
					$_SESSION['pseudo'] = $member->pseudo();
					$this->memberManager->update($member->id(), array('lastConnexion' => ''));
					header('Location: .');
				}
			}
			$message = 'Informations de connexion erronées.';
		}
		$this->createView(array(
			'message' => $message,
			'pseudo' => $pseudo));
	}

	public function logout()
	{
		if(isset($_SESSION['id']))
		{
			\session_destroy();
		}
		header('Location: .');
	}

	public function index()
	{
		$this->executeAction('signIn');
	}
}
