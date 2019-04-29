<?php

namespace projets_developpeur_web\projet_4\Model\Classes;

class Comment
{
	private $id;
	private $authorId;
	private $author;
	private $episodeId;
	private $comment;
	private $commentDate;
	private $updateDate;

	public function __construct(array $commentData)
	{
		$this->hydrate($commentData);
	}

	public function hydrate(array $commentData)
	{
		foreach ($commentData as $key => $value)
		{
			$method = 'set' . ucfirst($key);
			
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	public function id()
	{
		return $this->id;
	}
	
	public function authorId()
	{
		return $this->authorId;
	}

	public function author()
	{
		return $this->author;
	}
	
	public function episodeId()
	{
		return $this->episodeId;
	}
	
	public function comment()
	{
		return $this->comment;
	}
	
	public function commentDate()
	{
		return $this->commentDate;
	}

	public function updateDate()
	{
		return $this->updateDate;
	}
	
	public function setId($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}
		else
		{
			throw new \Exception('Incorrect id value');
		}
	}
	
	public function setAuthorId($authorId)
	{
		$authorId = (int) $authorId;
		if ($authorId > 0)
		{
			$this->authorId = $authorId;
		}
		else
		{
			throw new \Exception('Incorrect id value');
		}
	}

	public function setAuthor($author)
	{
		$this->author = htmlspecialchars($author);
	}

	public function setEpisodeId($episodeId)
	{
		$episodeId = (int) $episodeId;
		if ($episodeId > 0)
		{
			$this->episodeId = $episodeId;
		}
		else
		{
			throw new \Exception('Incorrect id value');
		}
	}

	public function setComment($comment)
	{
		$this->comment = htmlspecialchars($comment);
	}
	
	public function setCommentDate($commentDate)
	{
		$commentDate = new \DateTime($commentDate);
		$date = $commentDate->format('d/m/Y à H\hi');
		$this->commentDate = $date;
	}
	
	public function setUpdateDate($updateDate)
	{
		if(isset($updateDate))
		{
			$updateDate = new \DateTime($updateDate);
			$date = $updateDate->format('d/m/Y à H\hi');
			$this->updateDate = $date;
		}
	}
}
