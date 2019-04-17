<?php

//namespace openclassrooms\dwj\projet4\bani\model;

class MySQLi_EpisodeManager extends EpisodeManager
{
	protected $db;

	public function __construct(\MySQLi $db)
	{
		$this->setDb($db);
	}

	public function setDb(\MySQLi $db)
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

	public function post(Episode $episode){}
	public function update(Episode $episode){}
	public function delete($id){}

	public function exists($id)
	{
		$q = $this->db->prepare('SELECT id FROM episodes WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();

		return $q->fetch();
	}
}
