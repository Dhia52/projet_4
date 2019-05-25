<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Framework\Controller;
use projets_developpeur_web\projet_4\Framework\Configuration;


class EpisodesController extends Controller
{
	protected $episodeManager;
	protected $commentManager;

	public function __construct()
	{
		$this->episodeManager = Manager::setManager('EpisodeManager', Configuration::get('DB_API'));
		$this->commentManager = Manager::setManager('CommentManager', Configuration::get('DB_API'));
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
				'episode' => $episode,
				'comments' => $comments,
				'nextDisable' => $nextDisable,
				'prevDisable' => $prevDisable,
				'commentTdClass' => $commentTdClass,
				'extraTdClass' => $extraTdClass));
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
