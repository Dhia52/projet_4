<?php

namespace projets_developpeur_web\projet_4\model;

use projets_developpeur_web\projet_4 as project;

class DBFactory
{
	private static $_host;
	private static $_dbname;
	private static $_user;
	private static $_password;
	private static $_class;

	private static function getParameters()
	{
		self::$_host = project\Configuration::get('host');
		self::$_dbname = project\Configuration::get('dbname');
		self::$_user = project\Configuration::get('user');
		self::$_password = project\Configuration::get('password');
		self::$_class = project\Configuration::get('class');
	}

	public static function setDb()
	{
		self::getParameters();

		switch(self::$_class)
		{
		case 'PDO':
			return self::setPDO();
			break;
		case 'MySQLi':
			return self::setMySQLi();
			break;
		default:
			throw new \Exception('Database not found');
		}
	}

	private static function setPDO()
	{
		$db = new \PDO('mysql:host=' . self::$_host . ';dbname=' . self::$_dbname . ';charset=utf8', self::$_user, self::$_password);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $db;
	}

	private static function setMySQLi()
	{
		$db = new \MySQLi(self::$_host, self::$_user, self::$_password, self::$_dbname);
		$db->set_charset("utf8");

		return $db;
	}
}
