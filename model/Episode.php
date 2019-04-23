<?php

namespace projets_developpeur_web\projet_4\model;

class Episode
{
	private $id;
	private $title;
	private $content;
	private $postDate;
	private $updateDate;

	public function __construct(array $episodeData)
	{
		$this->hydrate($episodeData);
	}

	public function hydrate(array $episodeData)
	{
		foreach ($episodeData as $key => $value)
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
	
	public function title()
	{
		return $this->title;
	}
	
	public function content()
	{
		return $this->content;
	}
	
	public function postDate()
	{
		return $this->postDate;
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
	
	public function setTitle($title)
	{
		if (strlen($title) <= 50)
		{
			$this->title = $title;
		}
		else
		{
			throw new \Exception('Overlong episode title');
		}
	}
	
	public function setContent($text)
	{
		$this->content = $text;
	}
	
	public function setPostDate($postDate)
	{
		$postDate = new \DateTime($postDate);
		$date = $postDate->format("d/m/Y");
		$this->postDate = $date;
	}
	
	public function setUpdateDate($updateDate)
	{
		if(isset($updateDate))
		{
			$updateDate = new \DateTime($updateDate);
			$date = $updateDate->format("d/m/Y");
			$this->updateDate = $date;
		}
	}
}
