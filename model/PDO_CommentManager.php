<?php

class PDO_CommentManager extends CommentManager
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

	public function getList(int $id = NULL, $class = NULL)
	{
		$list = [];

		if(isset($id) && isset($class))
		{
			switch($class)
			{
				case 'episode':
					$request = 'SELECT * FROM comments WHERE episode_id = :id ORDER BY id DESC';
					break;

				case 'member':
					$request = 'SELECT * FROM comments WHERE member_id = :id ORDER BY id DESC';
					break;
			}

			$q = $this->db->prepare($request);
			$q->bindValue(':id', $id, PDO::PARAM_INT);
			$q->execute();
		}
		else
		{
			$q = $this->db->query('SELECT * FROM comments ORDER BY id DESC');
		}
		
		while ($data = $q->fetch())
		{
			$list[] = new Comment($data);
		}

		return $list;
	}

	public function getComment($id){}
	public function post(Comment $comment){}
	public function update(Comment $comment){}
	public function delete($id){}
	public function exists($id){}
}
