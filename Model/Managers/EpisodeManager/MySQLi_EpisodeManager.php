<?php

namespace projets_developpeur_web\projet_4\Model\Managers\EpisodeManager;

use projets_developpeur_web\projet_4\Model\Classes\Episode;

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
			$list[] = new Episode($data);
		}

		return $list;
	}

	public function getEpisode($id)
	{
		$q = $this->db->prepare('SELECT * FROM episodes WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();

		$episodeData = $q->get_result()->fetch_assoc();

		return new Episode($episodeData);
	}

	public function post(Episode $episode)
	{
		$title = $episode->title();
		$content = $episode->content();

		$q = $this->db->prepare('INSERT INTO episodes (title, content, postDate) VALUES (?, ?, NOW())');
		$q->bind_param('ss', $title, $content);
		$q->execute();
	}

	public function update(Episode $episode){}

	public function delete($id)
	{
		$q = $this->db->prepare('DELETE FROM episodes WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();
	}

	public function count()
	{
		$result = $this->db->query('SELECT COUNT(*) AS Episodes FROM episodes');
		$count = $result->fetch_assoc();
		return $count['Episodes'];
	}
	public function exists($id)
	{
		$q = $this->db->prepare('SELECT id FROM episodes WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();

		return $q->fetch();
	}
}
