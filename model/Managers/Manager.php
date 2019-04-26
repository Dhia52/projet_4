<?php

namespace projets_developpeur_web\projet_4\model\Managers;

use projets_developpeur_web\projet_4\model\Managers as Managers;
use projets_developpeur_web\projet_4\model as model;

abstract class Manager
{
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public static function setManager($manager, $class)
	{
		$child = "projets_developpeur_web\projet_4\model\Managers\\$manager\\$class" . "_$manager";

		if(class_exists($child))
		{
			return new $child(model\DBFactory::setDb());
		}
		else
		{
			throw new \Exception('Required class does not exist');
		}
	}
}
