<?php

namespace projets_developpeur_web\projet_4\Model\Managers\CommentManager;

use projets_developpeur_web\projet_4\Model\Classes\Comment;
use projets_developpeur_web\projet_4\Model\Managers as Managers;

class MySQLi_CommentManager extends CommentManager
{
	public function getList(int $id = NULL, $class= NULL)
	{
		$list = [];

		if(isset($id) && isset($class))
		{
			switch($class)
			{
			case 'episode':
				$request = 'SELECT c.id, c.authorId, c.comment, c.commentDate, c.updateDate, m.pseudo AS author FROM comments AS c INNER JOIN members AS m ON c.authorId = m.id WHERE episodeId = ? ORDER BY c.id DESC';
				break;

			case 'member':
				$request = 'SELECT * FROM comments WHERE authorId = ? ORDER BY id DESC';
				break;
			}
		
			$q = $this->db->prepare($request);
			$q->bind_param('i', $id);
			$q->execute();
			
			$result = $q->get_result();
		}
		else
		{
			$result = $this->db->query('SELECT * FROM comments ORDER BY id DESC');
		}


		while ($commentData = $result->fetch_assoc())
		{
			$list[] = new Comment($commentData);
		}

		return $list;
	}

	public function getComment($id)
	{
		$q = $this->db->prepare('SELECT * FROM comments WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();

		$commentData = $q->get_result()->fetch_assoc();

		return new Comment($commentData);
	}

	public function post(Comment $comment)
	{
		$episodeId = $comment->episodeId();
		$authorId = $comment->authorId();
		$text = $comment->comment();

		$q = $this->db->prepare('INSERT INTO comments (episodeId, authorId, comment, commentDate) VALUES (?, ?, ?, NOW())');
		$q->bind_param('iis', $episodeId, $authorId, $text);
		$q->execute();
	}

	public function update(Comment $comment)
	{
		$commentId = $comment->id();
		$content = $comment->comment();

		$q = $this->db->prepare('UPDATE comments SET comment = ?, updateDate = NOW() WHERE id = ?');
		$q->bind_param('si', $content, $commentId);
		$q->execute();
	}

	public function delete($id){}

	public function exists($id)
	{
		$q = $this->db->prepare('SELECT id FROM comments WHERE id = ?');
		$q->bind_param('i', $id);
		$q->execute();

		return $q->fetch();
	}

	public function count($id = NULL, $class = NULL)
	{
		if(isset($id) && isset($class))
		{
			switch($class)
			{
			case 'member':
				$request = 'SELECT COUNT(*) AS Comments FROM comments WHERE authorId = ?';
				break;

			case 'episode':
				$request = 'SELECT COUNT(*) AS Comments FROM comments WHERE episodeId = ?';
				break;
			}

			$q = $this->db->prepare($request);
			$q->bind_param('i', $id);
			$q->execute();

			$result = $q->get_result();
		}
		else
		{
			$result = $this->db->query('SELECT COUNT(*) AS Comments FROM comments');
		}

		return $result->fetch_assoc();
	}
}
