<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Model\Classes\Member;
use projets_developpeur_web\projet_4\Framework\Controller;
use projets_developpeur_web\projet_4\Framework\Configuration;


class SessionsController extends Controller
{
	protected $memberManager;

	public function __construct()
	{
		$this->memberManager = Manager::setManager('MemberManager', Configuration::get('DB_API'));
	}

	public function signIn()
	{
		if(isset($_SESSION['id']))
		{
			header('Location: .');
		}
		else
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
					$_SESSION['category'] = 'Reader';
					header('Location: .');
				}
			}
			$this->createView(array(
				'message' => $message,
				'pseudo' => $pseudo));
		}
	}

	public function login()
	{
		if(isset($_SESSION['id']))
		{
			header('Location: .');
		}
		else
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
						$_SESSION['category'] = $member->category();
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
	}

	public function logout()
	{
		if(isset($_SESSION['id']))
		{
			\session_destroy();
		}
		header('Location: .');
	}

	public function resetPassword()
	{
		if(empty($_SESSION))
		{
			$message = '';

			if(!empty($_POST))
			{
				if($this->request->exists('pseudo') && $this->request->exists('email'))
				{
					$pseudo = $this->request->getParam('pseudo');
					$email = $this->request->getParam('email');
					if($this->memberManager->exists($pseudo))
					{
						$member = $this->memberManager->getMember($pseudo);
						if($email === $member->email())
						{
							$newPassword = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
							for($i = 0; $i <= 50; $i++)
							{
								$length = \strlen($newPassword);
								$pos = \rand(0, $length - 1);
								$newPassword = \str_replace($newPassword[$pos], '', $newPassword);
							}
							$newPassword = \str_shuffle($newPassword);
							$this->memberManager->update($member->id(), array('password' => \password_hash($newPassword, PASSWORD_DEFAULT)));
							/*$emailContent = "Bonjour $pseudo.\r\nVous avez effectué une demande de réinitialisation de mot de passe sur le blog de Billet simple pour l'Alaska. Une fois connecté, nous vous conseillons de redéfinir votre propre mot de passe depuis la page de modification de compte accessible depuis votre page de profil.\r\nVotre nouveau mot de passe est $newPassword.\r\n\r\nA bientôt sur notre blog !";
							$emailContent = \wordwrap($emailContent, 70, "\r\n");
							\mail($email, "Billet simple pour l'Alaska - Réinitialisation de mot de passe", $emailContent, "From: dhia.bani@gmail.com");
							$message = "Un email a été envoyé à l'adresse suivante : $email.";*/
							$message = "Mot de passe réinitialisé. Assurez-vous de le modifier dès que possible dans les paramètres de votre compte.<br/>Le mot de passe est : $newPassword";
						}
						else
						{
							$message = 'Données erronées';
						}
					}
					else
					{
						$message = 'Données erronées';
					}
				}
			}
			$this->createView(array('message' => $message));
		}
		else
		{
			header('Location: .');
		}
	}

	public function index()
	{
		$this->executeAction('signIn');
	}
}
