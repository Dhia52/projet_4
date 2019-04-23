<?php

namespace projets_developpeur_web\projet_4\controller;

use projets_developpeur_web\projet_4 as project;

class HomeController
{
	protected $episodeManager;

	public function __construct()
	{
		$this->episodeManager = new project\model\MySQLi_EpisodeManager(project\model\DBFactory::setMySQLi());
	}

	public function homepage()
	{
		$list = $this->episodeManager->getList(6);
		$view = new project\view\View(array ('file' => 'home'));
		$view->render(array('list' => $list));
	}
}
