<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model\Classes\Member;
use projets_developpeur_web\projet_4\Model as Model;
use projets_developpeur_web\projet_4\Framework as Framework;
use projets_developpeur_web\projet_4 as project;


class MembersController extends Framework\Controller
{
	protected $memberManager;
	protected $commentManager;

	public function __construct()
	{
		$this->memberManager = Managers\Manager::setManager('MemberManager', Framework\Configuration::get('DB_API'));
		$this->commentManager = Managers\Manager::setManager('CommentManager', Framework\Configuration::get('DB_API'));
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

					if(empty($_POST))
					{
						echo '$_POST !';
					}
					$this->createView(array(
						'member' => $member,
						'message' => $message));
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
	}

	public function index()
	{
		header('Location: .');
	}
}
