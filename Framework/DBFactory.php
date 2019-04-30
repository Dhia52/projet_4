<?php

namespace projets_developpeur_web\projet_4\Framework;

class DBFactory
{
	private static $_host;
	private static $_dbname;
	private static $_user;
	private static $_password;
	private static $_api;

	private static function getParameters()
	{
		self::$_host = Configuration::get('host');
		self::$_dbname = Configuration::get('dbname');
		self::$_user = Configuration::get('user');
		self::$_password = Configuration::get('password');
		self::$_api = Configuration::get('DB_API');
	}

	public static function setDb()
	{
		self::getParameters();

		$method = 'set' . self::$_api;

		if(method_exists(__CLASS__, $method))
		{
			return self::$method();
		}
		else
		{
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
