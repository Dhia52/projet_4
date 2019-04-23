<?php

namespace projets_developpeur_web\projet_4\model;

abstract class Manager
{
	protected static $db;
	private static $_class = Configuration::get('class');

	public static function __construct()
	{
		self::setDb();
	}

	private static function setDb()
	{
		if(self::$_class == 'PDO')
		{
			self::$db = DBFactory::setPDO();
		}
		elseif(self::$_class == 'MySQLi')
		{
			self::$db = DBFactory::setMySQLi();
		}
	}
}
