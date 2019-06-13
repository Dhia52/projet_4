<?php

namespace projets_developpeur_web\projet_4\Model\Classes;

class Member
{
	protected $id;
	protected $category;
	protected $pseudo;
	protected $email;
	protected $password;
	protected $signDate;
	protected $lastConnexion;

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
	
	public function email()
	{
		return $this->email;
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

	public function setCategory($category)
	{
		if(in_array($category, array('Admin', 'Writer', 'Mod', 'Reader')))
		{
			$this->category = $category;
		}
		else
		{
			$this->category = 'Reader';
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
	
	public function setEmail($email)
	{
		if (\strlen($email) <= 50 && \preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9]{2,}\.[a-z]{2,4}$#", $email))
		{
			$this->email = $email;
		}
		else
		{
			throw new \Exception('Invalid email address');
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
