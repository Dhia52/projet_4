<?php

class Member
{
	private $id;
	private $category;
	private $pseudo;
	private $pass;
	private $signDate;
	private $lastConnexion;

	public function __construct(array $memberData)
	{
		$this->hydrate($memberData);
	}

	public function hydrate(array $memberData)
	{
		foreach ($memberData as $key => $value)
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
	
	public function category()
	{
		return $this->category;
	}
	
	public function pseudo()
	{
		return $this->pseudo;
	}
	
	public function pass()
	{
		return $this->pass;
	}
	
	public function signDate()
	{
		return $this->signDate;
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
	
	public function setPseudo($pseudo)
	{
		if (strlen($pseudo) <= 20)
		{
			$this->pseudo = $pseudo;
		}
		else
		{
			throw new Exception('Overlong username');
		}
	}
	
	public function setPass($pass)
	{
		if (strlen($pass) >= 8)
		{
			$this->content = $text;
		}
		else
		{
			throw new Exception('Weak password');
		}
	}
	
	public function setSignDate($signDate)
	{
		if ($signDate > time())
		{
			$this->signDate = $signDate;
		}
		else
		{
			throw new Exception('Incorrect date value');
		}
	}
	
	public function setLastConnexion($lastConnexion)
	{
		if ($lastConnexion > time())
		{
			$this->lastConnexion = $lastConnexion;
		}
		else
		{
			throw new Exception('Incorrect date value');
		}
	}
}
