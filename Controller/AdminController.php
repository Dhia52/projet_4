<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Model as Model;
use projets_developpeur_web\projet_4\Framework\Configuration;
use projets_developpeur_web\projet_4\Framework\Controller;


class AdminController extends Controller
{
	protected $commentManager;
	protected $episodeManager;
	protected $memberManager;

	public function __construct()
	{
		$this->commentManager = Manager::setManager('CommentManager', Configuration::get('DB_API'));
		$this->episodeManager = Manager::setManager('EpisodeManager', Configuration::get('DB_API'));
		$this->memberManager = Manager::setManager('MemberManager', Configuration::get('DB_API'));
	}

	protected function userCheck()
	{
		if(empty($_SESSION['category']) || !(in_array($_SESSION['category'], array('Admin', 'Writer', 'Mod'))))
		{
			header('Location: .');
		}
	}

	public function index()
	{
		$this->userCheck();

		$nb_episodes = $this->episodeManager->count();
		$nb_members = $this->memberManager->count();
		$nb_comments = $this->commentManager->count();

		$this->createView(array(
			'nb_episodes' => $nb_episodes,
			'nb_members' => $nb_members,
			'nb_comments' => $nb_comments));
	}
}
