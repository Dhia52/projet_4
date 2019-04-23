<?php

//namespace openclassrooms\dwj\projet4\bani\model;

class PDO_EpisodeManager extends EpisodeManager
{
	protected $db;

	public function __construct(\PDO $db)
	{
		$this->setDb($db);
	}

	public function setDb(\PDO $db)
	{
		$this->db = $db;
	}

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

		while($data = $q->fetch(PDO::FETCH_ASSOC))
		{
			$list[] = new Episode($data);
		}

		return $list;
	}

	public function getEpisode($id)
	{
		$q = $this->db->prepare('SELECT * FROM episodes WHERE id = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();

		$episodeData = $q->fetch(PDO::FETCH_ASSOC);

		return new Episode($episodeData);
	}

	public function post(Episode $episode){}
	public function update(Episode $episode){}
	public function delete($id){}

	public function exists(int $id)
	{
		$q = $this->db->prepare('SELECT COUNT(*) FROM episodes WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();

		return (bool) $q->fetchColumn();
	}
}