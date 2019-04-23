<?php

namespace projets_developpeur_web\projet_4;

class Configuration
{
	protected static $parameters;

	public static function get($name, $default = NULL)
	{
		if(isset(self::getParameters()[$name]))
		{
			$value = self::getParameters()[$name];
		}
		else
		{
			$value = $default;
		}
		return $value;
	}

	protected static function getParameters()
	{
		if(self::$parameters == NULL)
		{
			$filePath = 'Config/prod.ini';
			if(!file_exists($filePath))
			{
				$filePath = 'Config/dev.ini';
			}
			if(!file_exists($filePath))
			{
				throw new \Exception('No configuration file');
			}
			else
			{
				self::$parameters = parse_ini_file($filePath);
			}
		}
		return self::$parameters;
	}
}
