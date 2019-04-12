<?php

class MySQLi_CommentManager extends CommentManager
{
	protected $db;

	public function __construct(MySQLi $db)
	{
		$this->setDb($db);
	}

	public function setDb(MySQLi $db)
	{
		$this->db = $db;
	}

	public function getList($id){}

	public function getUserCommentsList($id)
	{
		$list = [];
		
		$q = $this->db->prepare('SELECT * FROM comments ORDER BY id DESC');

		while ($data = $q->fetch_assoc())
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
