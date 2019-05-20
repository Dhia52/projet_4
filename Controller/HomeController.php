<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model as Model;
use projets_developpeur_web\projet_4\Framework as Framework;
use projets_developpeur_web\projet_4 as project;


class HomeController extends Framework\Controller
{
	protected $episodeManager;

	public function __construct()
	{
		$this->episodeManager = Managers\Manager::setManager('EpisodeManager', Framework\Configuration::get('DB_API'));
	}

	public function index()
	{
		$list = $this->episodeManager->getList(6);
		$this->createView(array('list' => $list));
	}

	public function about()
	{
		$this->createView();
	}
}
