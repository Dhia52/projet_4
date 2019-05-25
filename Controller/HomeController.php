<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Framework\Controller;
use projets_developpeur_web\projet_4\Framework\Configuration;


class HomeController extends Controller
{
	protected $episodeManager;

	public function __construct()
	{
		$this->episodeManager = Manager::setManager('EpisodeManager', Configuration::get('DB_API'));
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
