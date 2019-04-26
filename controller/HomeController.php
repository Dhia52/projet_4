<?php

namespace projets_developpeur_web\projet_4\controller;

use projets_developpeur_web\projet_4\model\Managers as Managers;
use projets_developpeur_web\projet_4\model as model;
use projets_developpeur_web\projet_4\Framework as Framework;
use projets_developpeur_web\projet_4 as project;


class HomeController extends Framework\Controller
{
	protected $episodeManager;

	public function __construct()
	{
		$this->episodeManager = Managers\Manager::setManager('EpisodeManager', project\Configuration::get('class'));
	}

	public function homepage()
	{
		$list = $this->episodeManager->getList(6);
		$view = new Framework\View(array ('file' => 'home'));
		$view->render(array('list' => $list));
	}
}
