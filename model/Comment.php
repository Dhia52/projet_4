<?php

class Comment
{
	private $id;
	private $memberId;
	private $author;
	private $episodeId;
	private $comment;
	private $commentDate;
	private $lastUpdate;

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
	
	public function memberId()
	{
		return $this->memberId;
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

	public function lastUpdate()
	{
		return $this->lastUpdate;
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
			throw new Exception('Incorrect id value');
		}
	}
	
	public function setMemberId($memberId)
	{
		$memberId = (int) $memberId;
		if ($memberId > 0)
		{
			$this->memberId = $memberId;
		}
		else
		{
			throw new Exception('Incorrect id value');
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
			throw new Exception('Incorrect id value');
		}
	}

	public function setComment($comment)
	{
		$this->comment = htmlspecialchars($comment);
	}
	
	public function commentDate($commentDate)
	{
		$commentDate = new DateTime($commentDate);
		$date = $commentDate->format('d/m/Y à H\hi');
		$this->commentDate = $date;
	}
	
	public function setLastUpdate($lastUpdate)
	{
		$lastUpdate = new DateTime($lastUpdate);
		$date = $lastUpdate->format('d/m/Y à H\hi');
		$this->lastUpdate = $date;
	}
}
