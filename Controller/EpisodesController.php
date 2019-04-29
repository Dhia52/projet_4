<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model as Model;
use projets_developpeur_web\projet_4\Framework as Framework;
use projets_developpeur_web\projet_4 as project;


class EpisodesController extends Framework\Controller
{
	protected $episodeManager;

	public function __construct()
	{
		$this->episodeManager = Managers\Manager::setManager('EpisodeManager', Framework\Configuration::get('class'));
	}

	public function list()
	{
		$list = $this->episodeManager->getList();
		$this->createView(array('list' => $list));
	}

	public function index()
	{
		$this->executeAction('list');
	}
}
