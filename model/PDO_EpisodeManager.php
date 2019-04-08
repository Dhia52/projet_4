<?php

class PDO_EpisodeManager extends EpisodeManager
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
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

	public function getEpisode($info){}
	public function post(Episode $episode){}
	public function update(Episode $episode){}
	public function delete($id){}
	public function exists($info){}
}
