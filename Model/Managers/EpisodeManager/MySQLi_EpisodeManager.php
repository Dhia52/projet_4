<?php

namespace projets_developpeur_web\projet_4\Model\Managers\EpisodeManager;

use projets_developpeur_web\projet_4\Model\Classes as Classes;
use projets_developpeur_web\projet_4\Model\Managers as Managers;

class MySQLi_EpisodeManager extends EpisodeManager
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

		while ($data = $q->fetch_assoc())
		{
			$list[] = new Classes\Episode($data);
		}

		return $list;
	}

	public function getEpisode($id)
	{
		$q = $this->db->prepare('SELECT * FROM episodes WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();

		$episodeData = $q->get_result()->fetch_assoc();

		return new Classes\Episode($episodeData);
	}

	public function post(Classes\Episode $episode){}
	public function update(Classes\Episode $episode){}
	public function delete($id){}

	public function exists($id)
	{
		$q = $this->db->prepare('SELECT id FROM episodes WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();

		return $q->fetch();
	}
}
