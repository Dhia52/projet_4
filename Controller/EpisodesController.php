<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Model as Model;
use projets_developpeur_web\projet_4\Framework as Framework;
use projets_developpeur_web\projet_4 as project;


class EpisodesController extends Framework\Controller
{
	protected $episodeManager;
	protected $commentManager;

	public function __construct()
	{
		$this->episodeManager = Managers\Manager::setManager('EpisodeManager', Framework\Configuration::get('DB_API'));
		$this->commentManager = Managers\Manager::setManager('CommentManager', Framework\Configuration::get('DB_API'));
	}

	public function list()
	{
		$list = $this->episodeManager->getList();
		$this->createView(array('list' => $list));
	}

	public function read()
	{
		$id = (int) $this->request->getParam('id');

		if($this->episodeManager->exists($id))
		{
			$prevDisable = ' disabled';
			$nextDisable = ' disabled';
			
			$episode = $this->episodeManager->getEpisode($id);
			$comments = $this->commentManager->getList($id, 'episode');

			if($this->episodeManager->exists($id - 1))
			{
				$prevDisable = '';
			}

			if($this->episodeManager->exists($id + 1))
			{
				$nextDisable = '';
			}

			$this->createView(array(
				'episode' => $episode,
				'comments' => $comments,
				'nextDisable' => $nextDisable,
				'prevDisable' => $prevDisable));
		}
		else
		{
			throw new \Exception('Requested episode does not exist.');
		}
	}

	public function index()
	{
		$this->executeAction('list');
	}
}
