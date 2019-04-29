<?php

namespace projets_developpeur_web\projet_4\Model\Managers;

use projets_developpeur_web\projet_4\Model\Managers as Managers;
use projets_developpeur_web\projet_4\Framework as Framework;

abstract class Manager
{
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public static function setManager($manager, $class)
	{
		$child = "projets_developpeur_web\projet_4\Model\Managers\\$manager\\$class" . "_$manager";

		if(class_exists($child))
		{
			return new $child(Framework\DBFactory::setDb());
		}
		else
		{
			throw new \Exception('Required class does not exist');
		}
	}
}
