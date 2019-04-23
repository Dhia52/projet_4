<?php

namespace projets_developpeur_web\projet_4\model;

class Member
{
	private $id;
	private $category;
	private $pseudo;
	private $password;
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
	
	public function password()
	{
		return $this->password;
	}
	
	public function signDate()
	{
		return $this->signDate;
	}

	public function lastConnexion()
	{
		return $this->lastConnexion;
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
	
	public function setPseudo($pseudo)
	{
		if (strlen($pseudo) <= 20)
		{
			$this->pseudo = $pseudo;
		}
		else
		{
			throw new \Exception('Overlong username');
		}
	}
	
	public function setPassword($password)
	{
		if (strlen($password) >= 8)
		{
			$this->password = $password;
		}
		else
		{
			throw new \Exception('Weak password');
		}
	}
	
	public function setSignDate($signDate)
	{
		$signDate = new \DateTime($signDate);
		$date = $signDate->format('d/m/Y à H\hi');
		$this->signDate = $date;
	}
	
	public function setLastConnexion($lastConnexion)
	{
		$lastConnexion = new \DateTime($lastConnexion);
		$date = $lastConnexion->format('d/m/Y à H\hi');
		$this->lastConnexion = $date;
	}
}
