<?php

namespace projets_developpeur_web\projet_4\Model\Managers\EpisodeManager;

use projets_developpeur_web\projet_4\Model\Classes\Episode;

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
			$list[] = new Episode($data);
		}

		return $list;
	}

	public function getEpisode($id)
	{
		$q = $this->db->prepare('SELECT * FROM episodes WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();

		$episodeData = $q->fetch(\PDO::FETCH_ASSOC);

		return new Episode($episodeData);
	}

	public function post(Episode $episode)
	{
		$q = $this->db->prepare('INSERT INTO episodes (title, content, postDate) VALUES (:title, :content, NOW())');
		$q->bindValue(':title', $episode->title(), \PDO::PARAM_STR);
		$q->bindValue(':content', $episode->content(), \PDO::PARAM_STR);
		$q->execute();
	}

	public function update(array $data, int $episodeId)
	{
		foreach($data as $key => $value)
		{
			switch($key)
			{
			case 'id':
				$r = $this->db->prepare('UPDATE episodes SET id = :newId WHERE id = :id');
				$r->bindValue(':newId', $value, \PDO::PARAM_INT);
				$r->bindValue(':id', $episodeId, \PDO::PARAM_INT);
				$r->execute();
				$episodeId = $value;
				break;
			case 'title':
				$r = $this->db->prepare('UPDATE episodes SET title = :title WHERE id = :id');
				$r->bindValue(':title', $value, \PDO::PARAM_STR);
				$r->bindValue(':id', $episodeId, \PDO::PARAM_INT);
				$r->execute();
				break;
			case 'content':
				$r = $this->db->prepare('UPDATE episodes SET content = :content WHERE id = :id');
				$r->bindValue(':content', $value, \PDO::PARAM_STR);
				$r->bindValue(':id', $episodeId, \PDO::PARAM_INT);
				$r->execute();
				break;
			default:
				throw new \Exception("Incorrect parameter $key given for episode update");
			}
		}

		$q = $this->db->prepare('UPDATE episodes SET updateDate = NOW() WHERE id = :id');
		$q->bindValue(':id', $episodeId, \PDO::PARAM_INT);
		$q->execute();
	}

	public function delete($id)
	{
		$q = $this->db->prepare('DELETE FROM episodes WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();
	}

	public function count()
	{
		$q = $this->db->query('SELECT COUNT(*) FROM episodes');
		return $q->fetchColumn();
	}

	public function exists(int $id)
	{
		$q = $this->db->prepare('SELECT COUNT(*) FROM episodes WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();

		return (bool) $q->fetchColumn();
	}
}
