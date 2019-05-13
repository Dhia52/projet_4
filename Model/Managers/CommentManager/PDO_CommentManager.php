<?php

namespace projets_developpeur_web\projet_4\Model\Managers\CommentManager;

use projets_developpeur_web\projet_4\Model\Classes\Comment;
use projets_developpeur_web\projet_4\Model\Managers as Managers;

class PDO_CommentManager extends CommentManager
{
	public function getList(int $id = NULL, $class = NULL)
	{
		$list = [];

		if(isset($id) && isset($class))
		{
			switch($class)
			{
				case 'episode':
					$request = 'SELECT c.id, c.authorId, c.comment, c.commentDate, c.updateDate, m.pseudo AS author FROM comments AS c INNER JOIN members AS m ON c.authorId = m.id WHERE episodeId = :id ORDER BY c.id DESC';
					break;

				case 'member':
					$request = 'SELECT * FROM comments WHERE authorId = :id ORDER BY id DESC';
					break;
			}

			$q = $this->db->prepare($request);
			$q->bindValue(':id', $id, \PDO::PARAM_INT);
			$q->execute();
		}
		else
		{
			$q = $this->db->query('SELECT * FROM comments ORDER BY id DESC');
		}
		
		while ($data = $q->fetch(\PDO::FETCH_ASSOC))
		{
			$list[] = new Comment($data);
		}

		return $list;
	}

	public function getComment($id)
	{
		$q = $this->db->prepare('SELECT * FROM comments WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();

		$commentData = $q->fetch(\PDO::FETCH_ASSOC);

		return new Comment($commentData);
	}

	public function post(Comment $comment)
	{
		$q = $this->db->prepare('INSERT INTO comments (episodeId, authorId, comment, commentDate) VALUES (:episodeId, :authorId, :comment, NOW())');
		$q->bindValue(':episodeId', $comment->episodeId(), \PDO::PARAM_INT);
		$q->bindValue(':authorId', $comment->authorId(), \PDO::PARAM_INT);
		$q->bindValue(':comment', $comment->comment(), \PDO::PARAM_STR);
		$q->execute();
	}

	public function update(Comment $comment)
	{
		$q = $this->db->prepare('UPDATE comments SET comment = :comment, updateDate = NOW() WHERE id = :id');
		$q->bindValue(':comment', $comment->comment(), \PDO::PARAM_STR);
		$q->bindValue(':id', $comment->id(), \PDO::PARAM_INT);
		$q->execute();
	}

	public function delete($id)
	{
		$q = $this->db->prepare('DELETE FROM comments WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();
	}

	public function exists($id)
	{
		$q = $this->db->prepare('SELECT COUNT(*) FROM comments WHERE id = :id');
		$q->bindValue(':id', $id, \PDO::PARAM_INT);
		$q->execute();

		return (bool) $q->fetchColumn();
	}
	
	public function count($id = NULL, $class = NULL)
	{
		if(isset($id) && isset($class))
		{
			switch($class)
			{
			case 'member':
				$request = 'SELECT COUNT(*) AS Comments FROM comments WHERE authorId = :id';
				break;

			case 'episode':
				$request = 'SELECT COUNT(*) AS Comments FROM comments WHERE episodeId = :id';
				break;
			}

			$q = $this->db->prepare($request);
			$q->bindValue(':id', $id, \PDO::PARAM_INT);
			$q->execute();
		}
		else
		{
			$q = $this->db->query('SELECT COUNT(*) AS Comments FROM comments');
		}

		return $q->fetchColumn();
	}
}
