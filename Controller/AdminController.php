<?php

namespace projets_developpeur_web\projet_4\Controller;

use projets_developpeur_web\projet_4\Model\Managers\Manager;
use projets_developpeur_web\projet_4\Framework\Configuration;
use projets_developpeur_web\projet_4\Framework\Controller;
use projets_developpeur_web\projet_4\Model\Classes\Episode;


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

	protected function userCheck(array $categories)
	{
		if(empty($_SESSION['category']) || !(in_array($_SESSION['category'], $categories)))
		{
			header('Location: .');
		}
	}

	public function listEpisodes()
	{
		$this->userCheck(['Admin', 'Writer']);

		$nb_episodes = $this->episodeManager->count();
		$episodesList = $this->episodeManager->getList();

		$this->createView(array(
			'nb_episodes' => $nb_episodes,
			'episodesList' => $episodesList));
	}

	protected function writeEpisode()
	{
		$this->userCheck(['Admin', 'Writer']);

		$message = '';
		$content = '';
		$episodeId = '';
		$title = '';

		if($_POST)
		{

			$episode = new Episode(array());
			if($this->request->exists('id'))
			{
				$episodeId = (int) $this->request->getParam('id');
				if($episodeId > 0 && !$this->episodeManager->exists($episodeId))
				{
					$episode->setId($episodeId);
				}
			}
			if($this->request->exists('title') && $this->request->exists('episodeContent'))
			{
				$episode->setTitle($this->request->getParam('title'));
				$episode->setContent($this->request->getParam('episodeContent'));

				$this->episodeManager->post($episode);
				\header('Location: .?controller=admin&action=listEpisodes');
			}
			else
			{
				if($this->request->exists('title'))
				{
					$title = $this->request->getParam('title');
				}
				if($this->request->exists('content'))
				{
					$content = $this->request->getParam('content');
				}
				$message = 'Veuillez remplir les champs titre et texte.';
			}
		}
		$this->createView(array(
			'message' => $message,
			'episodeId' => $episodeId,
			'title' => $title,
			'content' => $content));
	}

	protected function editEpisode()
	{
		$this->userCheck(['Admin', 'Writer']);

		if($this->request->exists('episodeId'))
		{
			$episodeId = (int) $this->request->getParam('episodeId');
			$message = '';

			if($this->episodeManager->exists($episodeId))
			{
				$episode = $this->episodeManager->getEpisode($episodeId);
				$content = $episode->content();
				$title = $episode->title();

				if($_POST)
				{
					$updateData = [];
					foreach($_POST as $key => $value)
					{
						if($this->request->exists($key))
						{
							$updateData[$key] = $value;
						}
					}
					

					if($this->request->exists('id'))
					{
						$updateData['id'] = (int) $updateData['id'];
						if($this->episodeManager->exists($updateData['id']))
						{
							$message = "Impossible de déplacer l'épisode à la position souhaitée";
						}
						else
						{
							$this->episodeManager->update($updateData, $episodeId);
							\header('Location: .?controller=admin&action=listEpisodes');
						}
					}
					else
					{
						$this->episodeManager->update($updateData, $episodeId);
						\header('Location: .?controller=admin&action=listEpisodes');
					}
				}

				$this->createView(array(
					'message' => $message,
					'episodeId' => $episodeId,
					'title' => $title,
					'content' => $content));
			}
			else
			{
				throw new \Exception('Episode does not exist');
			}
		}
		else
		{
			throw new \Exception('Missing episode id');
		}
	}

	public function deleteEpisode()
	{
		$this->userCheck(['Admin', 'Writer']);

		if($this->request->exists('id'))
		{
			$episodeId = (int) $this->request->getParam('id');
			$this->episodeManager->delete($episodeId);
			\header('Location: .?controller=admin&action=listEpisodes');
		}
		else
		{
			throw new \Exception('Missing episode id to execute action');
		}
	}

	public function listMembers()
	{
		$this->userCheck(['Admin', 'Writer', 'Mod']);

		$nb_members = $this->memberManager->count();
		$membersList = $this->memberManager->getList();

		$this->createView(array(
			'nb_members' => $nb_members,
			'membersList' => $membersList));
	}

	public function listComments()
	{
		$this->userCheck(['Admin', 'Writer', 'Mod']);

		$nb_comments = $this->commentManager->count();
		$commentsList = $this->commentManager->getList();

		$this->createView(array(
			'nb_comments' => $nb_comments,
			'commentsList' => $commentsList));
	}

	public function index()
	{
		$this->userCheck(['Admin', 'Writer', 'Mod']);

		$nb_episodes = $this->episodeManager->count();
		$nb_members = $this->memberManager->count();
		$nb_comments = $this->commentManager->count();

		$this->createView(array(
			'nb_episodes' => $nb_episodes,
			'nb_members' => $nb_members,
			'nb_comments' => $nb_comments));
	}
}
