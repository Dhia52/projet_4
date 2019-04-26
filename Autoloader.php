<?php

namespace projets_developpeur_web\projet_4;

class Autoloader
{
	static function autoload($class)
	{
		$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
		echo $class . '<br>';
		require_once($_SERVER['DOCUMENT_ROOT'] . "/$class" . '.php');
	}

	static function register()
	{
		spl_autoload_register(array(__CLASS__, 'autoload'));
	}
}

