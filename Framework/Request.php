<?php

namespace projets_developpeur_web\projet_4\Framework;

class Request
{
	protected $params;

	public function __construct($params)
	{
		$this->params = $params;
	}

	public function exists($key)
	{
		return (isset($this->params[$key]) && $this->params[$key] !== '');
	}

	public function getParam($key)
	{
		if($this->exists($key))
		{
			return $this->params[$key];
		}
		else
		{
			throw new \Exception("Parameter $key does not exist.");
		}
	}
}
