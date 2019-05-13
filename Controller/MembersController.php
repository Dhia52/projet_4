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
				$this->createView(array(
					'member' => $member,
					'nb_comments' => $nb_comments,
					'list' => $commentsList));
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
	}

	public function delete()
	{
	}

	public function index()
	{
		header('Location: .');
	}
}
