<?php

class Comment
{
	private $id;
	private $memberId;
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
		$this->comment = $comment;
	}
	
	public function commentDate($commentDate)
	{
		if ($commentDate > time())
		{
			$this->commentDate = $commentDate;
		}
		else
		{
			throw new Exception('Incorrect date value');
		}
	}
	
	public function setLastUpdate($lastUpdate)
	{
		if ($lastUpdate > time())
		{
			$this->lastUpdate = $lastUpdate;
		}
		else
		{
			throw new Exception('Incorrect date value');
		}
	}
}
