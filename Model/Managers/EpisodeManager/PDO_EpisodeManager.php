<?php

namespace projets_developpeur_web\projet_4\Model\Managers\EpisodeManager;

use projets_developpeur_web\projet_4\Model\Classes as Classes;
use projets_developpeur_web\projet_4\Model\Managers as Managers;

class PDO_EpisodeManager extends EpisodeManager
{
	public function getList($nb = NULL)
	{
		$list = [];

		if(isset($nb))
		{
			$q = $this->db->query('SELECT * FROM episodes ORDER BY id DESC LIMIT 0,' . $nb);
		}
		else
		{
			$q = $this->db->query('SELECT * FROM episodes ORDER BY id DESC');
		}

		while($data = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$list[] = new Classes\Episode($data);
		}

		return $list;
	}

	public function getEpisode($id)
	{
		$q = $this->db->prepare('SELECT * FROM episodes WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();

		$episodeData = $q->fetch(\PDO::FETCH_ASSOC);

		return new Classes\Episode($episodeData);
	}

	public function post(Classes\Episode $episode){}
	public function update(Classes\Episode $episode){}
	public function delete($id){}

	public function exists(int $id)
	{
		$q = $this->db->prepare('SELECT COUNT(*) FROM episodes WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();

		return (bool) $q->fetchColumn();
	}
}
