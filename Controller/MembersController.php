<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Framework\Controller;
use projets_developpeur_web\projet_4\Framework\Configuration;


class MembersController extends Controller
{
	protected $memberManager;
	protected $commentManager;

	public function __construct()
	{
		$this->memberManager = Manager::setManager('MemberManager', Configuration::get('DB_API'));
		$this->commentManager = Manager::setManager('CommentManager', Configuration::get('DB_API'));
	}

	public function show()
	{
		if(isset($_GET['id']))
		{
			$memberId = (int) $_GET['id'];
			if($this->memberManager->exists($memberId))
			{
				$member = $this->memberManager->getMember($memberId);
				$nb_comments = $this->commentManager->count($memberId, 'member');
				$commentsList = $this->commentManager->getList($memberId, 'member');

				if(isset($_SESSION['id']))
				{
					$commentTdClass = 'col-md-7';
					$extraTdClass = 'col-md-2';
				}
				else
				{
					$commentTdClass = 'col-md-9';
					$extraTdClass = '';
				}

				$this->createView(array(
					'member' => $member,
					'nb_comments' => $nb_comments,
					'list' => $commentsList,
					'commentTdClass' => $commentTdClass,
					'extraTdClass' => $extraTdClass));
			}
			else
			{
				throw new \Exception('Member does not exist');
			}
		}
		else
		{
			throw new \Exception('Required id to display user info');
		}
	}

	public function edit()
	{
		if($this->request->exists('id'))
		{
			$memberId = (int) $this->request->getParam('id');
			if(isset($_SESSION['id']) && ($_SESSION['id'] === $memberId || in_array($_SESSION['category'], ['Admin', 'Writer'])))
			{
				if($this->memberManager->exists($memberId))
				{
					$member = $this->memberManager->getMember($memberId);
					$message = '';
					$confirmation = '';

					if(!empty($_POST))
					{
						$updateData = [];
						if($this->request->exists('pseudo'))
						{
							$newPseudo = $this->request->getParam('pseudo');
							$membersList = $this->memberManager->getList($memberId);
							if(in_array($newPseudo, $membersList))
							{
								$message .= "Le nom d'utilisateur $newPseudo ne peut être attribué.<br/>";
							}
							else
							{
								$updateData['pseudo'] = $newPseudo;
								$confirmation .= "Changement de nom d'utilisateur effectué avec succès<br/>";
								$_SESSION['pseudo'] = $newPseudo;
								$member->setPseudo($newPseudo);
							}
						}

						if($this->request->exists('newPassword'))
						{
							if($this->request->exists('oldPassword') && $this->request->exists('confirmPassword'))
							{
								$newPassword = $this->request->getParam('newPassword');
								$oldPassword = $this->request->getParam('oldPassword');
								if(!(password_verify($oldPassword, $member->password())))
								{
									$message .= 'Ancien mot de passe erroné.';
								}
								elseif(strlen($newPassword) < 8)
								{
									$message .= 'Nouveau mot de passe trop court';
								}
								elseif($newPassword !== $this->request->getParam('confirmPassword'))
								{
									$message .= 'Veuillez resaisir le nouveau mot de passe.';
								}
								else
								{
									$updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
									$confirmation .= 'Mot de passe modifié avec succès<br/>';
								}
							}
							else
							{
								$message .= 'Veuillez remplir les trois champs mot de passe pour modifier votre mot de passe.<br/>';
							}
						}

						if($this->request->exists('category'))
						{
							if(in_array($_SESSION['category'], ['Admin', 'Writer']))
							{
								$newCategory = $this->request->getParam('category');
								$updateData['category'] = $newCategory;
								$confirmation .= 'Changement de grade effectué avec succès';
								$member->setCategory($newCategory);
							}
							else
							{
								throw new \Exception('Unauthorised action');
							}
						}
						if($this->request->exists('email'))
						{
							$newEmail = $this->request->getParam('email');
							if(\preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $newEmail))
							{
								$updateData['email'] = $newEmail;
								$confirmation .= "Changement d'adresse e-mail effectué avec succès";
								$member->setEmail($newEmail);
							}
							else
							{
								$message .= 'Veuillez saisir une adresse e-mail valide.';
							}
						}

						$this->memberManager->update($memberId, $updateData);
					}

					$selectDisabled = $pseudoDisabled = 'disabled="disabled"';
					$selectOption1 = $selectOption2 = $selectOption3 = $selectOption4 = '';

					switch($member->category())
					{
					case 'Admin':
						$selectOption1 = 'selected="selected"';
						break;
					case 'Writer':
						$selectOption2 = 'selected="selected"';
						break;
					case 'Mod':
						$selectOption3 = 'selected="selected"';
						break;
					case 'Reader':
						$selectOption4 = 'selected="selected"';
						break;
					}

					if(\in_array($_SESSION['category'], ['Admin', 'Writer']))
					{
						$selectDisabled = '';
					}

					if($_SESSION['id'] === $memberId)
					{
						$pseudoDisabled = '';
					}

					$this->createView(array(
						'member' => $member,
						'pseudoDisabled' => $pseudoDisabled,
						'selectDisabled' => $selectDisabled,
						'selectOption1' => $selectOption1,
						'selectOption2' => $selectOption2,
						'selectOption3' => $selectOption3,
						'selectOption4' => $selectOption4,
						'message' => $message,
						'confirmation' => $confirmation));
				}
				else
				{
					throw new \Exception('Member not found');
				}
			}
			else
			{
				throw new \Exception('Denied access');
			}
		}
		else
		{
			throw new \Exception('Missing member id');
		}
	}

	public function delete()
	{
		if($this->request->exists('id'))
		{
			$memberId = (int) $this->request->getParam('id');
			if($_SESSION['id'] === $memberId || in_array($_SESSION['category'], ['Admin', 'Writer', 'Mod']))
			{
				$this->memberManager->delete($memberId);
				\session_destroy();
				\header('Location: .');
			}
			else
			{
				throw new \Exception('Unauthorised action');
			}
		}
		else
		{
			throw new \Exception('Cannot execute request');
		}
	}

	public function index()
	{
		header('Location: .');
	}
}
