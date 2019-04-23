<?php

namespace projets_developpeur_web\projet_4\model;

use projets_developpeur_web\projet_4 as project;

class DBFactory
{
	private static $_host;
	private static $_dbname;
	private static $_user;
	private static $_password;

	private static function getParameters()
	{
		self::$_host = project\Configuration::get('host');
		self::$_dbname = project\Configuration::get('dbname');
		self::$_user = project\Configuration::get('user');
		self::$_password = project\Configuration::get('password');
	}

	public static function setPDO()
	{
		self::getParameters();
		$db = new \PDO('mysql:host=' . self::$_host . ';dbname=' . self::$_dbname . ';charset=utf8', self::$_user, self::$_password);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $db;
	}

	public static function setMySQLi()
	{
		self::getParameters();
		$db = new \MySQLi(self::$_host, self::$_user, self::$_password, self::$_dbname);
		$db->set_charset("utf8");

		return $db;
	}
}
